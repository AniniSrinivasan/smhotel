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
require_once("functions.php");
requireLogin();

$errormessage = "";
$editingId = null;

$availableRooms = null;
$dateIn = $_POST['date-in'] ?? '';
$dateOut = $_POST['date-out'] ?? '';
$selectedHotelId = $_POST['hotel-id'] ?? '';

$db = createDB();

$errormessage = "";
$editingId = null;

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
?>

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
                        <th>Number of Guests</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php BookingList($editingId); ?>
                </tbody>

            </table>
            <br />
            <ul class="pagination">
                <li><a href="#">&laquo;</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </section>
    </div>
    <!-- Custom Delete Confirmation Popup -->
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