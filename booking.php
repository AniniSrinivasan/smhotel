<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S&M Dashboard</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400" rel="stylesheet" />
    <!-- using google fonts -->
    <script src="./nav.js"></script>
</head>

<?php
//https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.null-coalesce-op
require_once("functions.php");
requireLogin();
// carry session start - get userid - where userid - so no pagination - maybe do booking admin so the logic doesnt clash with admin - meaning it might only show admin booking!!

$action_error_message = "";
$editingId = null;

$availableRooms = null;
$dateIn = $_POST['date-in'] ?? '';
$dateOut = $_POST['date-out'] ?? '';
$selectedHotelId = $_POST['hotel-id'] ?? '';

$db = createDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['delete']) && isset($_POST['booking-id'])) {
        $id = $_POST['booking-id'];
        BookingDelete($id);
    }

    // save (updates the existing)
    if (isset($_POST['save']) && isset($_POST['booking-id'])) {
        $booking_id = $_POST['booking-id'];
        $room_id = $_POST['room-id'] ?? '';
        $guest_id = $_POST['guest-id'] ?? '';
        $num_guest = $_POST['num-guest'] ?? '';
        $dateIn = $_POST['date-in'] ?? '';
        $dateOut = $_POST['date-out'] ?? '';

        BookingUpdate($booking_id, $room_id, $guest_id, $num_guest, $dateIn, $dateOut);
    }

    // for edit mode
    if (isset($_POST['edit']) && isset($_POST['booking-id'])) {
        $editingId = $_POST['booking-id'];
    }

    // cancel edit mode
    if (isset($_POST['cancel'])) {
        $editingId = null;
    }
}

//pagination 
$records_per_page = 5;

//current page
$current_page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
if ($current_page < 1) {
    $current_page = 1;
}

$db = createDB();

//total records
// $total_query = "SELECT COUNT(*) AS total FROM BOOKING ";
// if (
//     isset($_SESSION['USER_ID']) &&
//     $_SESSION['ROLE'] === 'Guest') {

//         $total_query .= " WHERE USER_EMAIL = '".$_SESSION['EMAIL']."'";

// }

$total_query = "SELECT COUNT(*) AS total
                FROM BOOKING b
                INNER JOIN GUEST g ON b.GUEST_ID = g.GUEST_ID";

if (
    isset($_SESSION['USER_ID']) &&
    $_SESSION['ROLE'] === 'Guest'
) {
    $total_query .= " WHERE g.GUEST_EMAIL = '" . $_SESSION['EMAIL'] . "'";
}


$total_result = $db->query($total_query);
$total_row = $total_result->fetchArray(SQLITE3_ASSOC);
$total_records = (int) ($total_row['total'] ?? 0);

// calculating total pages - avoiding division by 0
$total_pages = $total_records > 0 ? (int) ceil($total_records / $records_per_page) : 1;

//offset calculation
$offset = ($current_page - 1) * $records_per_page;
?>

<!-- https://developer.mozilla.org/ -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector('.add-container form');
        const dateIn = document.getElementById('date-in');
        const dateOut = document.getElementById('date-out');
        const hotelId = document.getElementById('hotel-id');

        if (!form || !dateIn || !dateOut || !hotelId) return;

        function refreshAvailability() {
            form.submit();
        }

        dateIn.addEventListener('change', refreshAvailability);
        dateOut.addEventListener('change', refreshAvailability);
        hotelId.addEventListener('change', refreshAvailability);

    });
</script>

<body onload="loadNavbar()">
    <div id="navbar-container"></div> <!-- Navbar will be loaded here -->
    <div class="main_content">

        <section class="add-container">
            <div class="heading-row">
                <h2>Booking List</h2>
                <a class="add-btn" href="booking-add.php">Add Booking</a>
            </div>

            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search by Booking ID or Guest..." autocomplete="off"
                    onkeyup="filterBookingList(this)">
            </div>
            <table class="base-table">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Hotel</th>
                        <th>Guest</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>No. of Guests</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php BookingList($editingId, $records_per_page, $offset); ?>
                </tbody>
            </table>
            <!-- https://developer.mozilla.org
            https://www.php.net/manual/en/reserved.variables.get.php            
            https://www.php.net/manual/en/control-structures.if.php
            https://www.php.net/manual/en/language.basic-syntax.phpmode.php -->
            <?php if ($total_records > $records_per_page): ?>
            <ul class="pagination">
                <!-- previous button -->
                <?php if ($current_page > 1): ?>
                    <?php $prev_page = $current_page - 1; ?>
                    <li><a href="?page=<?= $prev_page ?>">&laquo;</a></li>
                <?php else: ?>
                    <li class="disabled"><span>&laquo;</span></li>
                <?php endif; ?>

                <!-- page numbers -->
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if ($i == $current_page): ?>
                        <li class="active"><span><?= $i ?></span></li>
                    <?php else: ?>
                        <li><a href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>

                <!-- next button -->
                <?php if ($current_page < $total_pages): ?>
                    <?php $next_page = $current_page + 1; ?>
                    <li><a href="?page=<?= $next_page ?>">&raquo;</a></li>
                <?php else: ?>
                    <li class="disabled"><span>&raquo;</span></li>
                <?php endif; ?>
            </ul>
            <?php endif; ?>
        </section>
    </div>
    <!-- delete confirmation popup -->
    <div id="deletePopup" class="popup-overlay" style="display: none;">
        <div class="popup-box">
            <h3>Delete</h3>
            <p>Are you sure you want to delete this?</p>
            <div class="popup-actions">
                <button class="confirm-delete">Yes, Delete</button>
                <button class="cancel-delete">Cancel</button>
            </div>
        </div>
    </div>
</body>

</html>