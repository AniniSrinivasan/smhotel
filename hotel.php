<!-- Artificial Intelligence (AI) has not been used for any part of the activity.  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S&M Hotel</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400" rel="stylesheet" />
    <!-- using google fonts -->
    <script src="./nav.js"></script>
</head>

<?php
require_once("functions.php");
requireLogin();

// $action_message = "";
$action_error_message = "";
$editingId = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // delete
    if (isset($_POST["delete"]) && isset($_POST["hotel-id"])) {
        $id = $_POST["hotel-id"];
        HotelDelete($id);
        exit();
    }
    
    // save (updates the existing)
    if (isset($_POST["save"]) && isset($_POST["hotel-id"])) {
        $id = $_POST["hotel-id"];
        $city = $_POST["city"] ?? "";
        $postcode = $_POST["postcode"] ?? "";
        $address = $_POST["address"] ?? "";
        $email = $_POST["email"] ?? "";
        $phone = $_POST["tel-no"] ?? "";
    
        HotelUpdate($id, $city, $address, $postcode, $email, $phone);
        exit();
    }
    
    // for edit mode
    if (isset($_POST["edit"]) && isset($_POST["hotel-id"])) {
        $editingId = $_POST["hotel-id"];
    }
    
    // Cancel edit mode
    if (isset($_POST["cancel"])) {
        $editingId = null;
    }
}

//**** pagination logic start ****
$records_per_page = 5;

//current page
$current_page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
if ($current_page < 1) {
    $current_page = 1;
}

$db = createDB();

//total records
$total_query = "SELECT COUNT(*) AS total FROM HOTEL";
$total_result = $db->query($total_query);
$total_row = $total_result->fetchArray(SQLITE3_ASSOC);
$total_records = (int) ($total_row['total'] ?? 0);

// calculating total pages - avoiding division by 0
$total_pages = $total_records > 0 ? (int) ceil($total_records / $records_per_page) : 1;

//offset calculation
$offset = ($current_page - 1) * $records_per_page;
//**** pagination logic end ****

?>

<body onload="loadNavbar()">
    <div id="navbar-container"></div> <!-- Navbar will be loaded here -->
    <div class="main_content">
        <section class="add-container">
            <div class="heading-row">
                <h2>Hotel List</h2>
                <a class="add-btn" href="hotel-add.php">Add Hotel</a>
            </div>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search by Hotel ID or Branch Name..."
                    autocomplete="off" onkeyup="filterHotelList(this)">
            </div>
            <table class="base-table">
                <thead>
                    <tr>
                        <th>Hotel ID</th>
                        <th>Branch</th>
                        <th>Postcode</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
    <?php HotelList($editingId, $records_per_page, $offset); ?>
</tbody>

                </tbody>
            </table>
            <br />
            <?php if ($total_records > $records_per_page): ?>
            <ul class="pagination">
                <!-- Previous button -->
                <?php if ($current_page > 1): ?>
                    <?php $prev_page = $current_page - 1; ?>
                    <li><a href="?page=<?= $prev_page ?>">&laquo;</a></li>
                <?php else: ?>
                    <li class="disabled"><span>&laquo;</span></li>
                <?php endif; ?>

                <!-- Page numbers -->
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if ($i == $current_page): ?>
                        <li class="active"><span><?= $i ?></span></li>
                    <?php else: ?>
                        <li><a href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>

                <!-- Next button -->
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