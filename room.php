<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S&M Dashboard</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400" rel="stylesheet" />
    <script src="./nav.js"></script>
    <!-- using google fonts -->
</head>

<?php
require_once("functions.php");
requireLogin();

$errormessage = "";
$editingId = null;

// delete
if (isset($_POST["delete"]) && isset($_POST["room-id"])) {
    $id = $_POST["room-id"];
    RoomDelete($id);
    exit();
}

// save (updates the existing)
if (isset($_POST["save"]) && isset($_POST["room-id"])) {
    $id = $_POST["room-id"];
    $hotel_id = $_POST["hotel-id"] ?? "";
    $room_type_id = $_POST["room-type-id"] ?? "";
    $room_number = $_POST["room-number"] ?? "";
    $price = $_POST["room-price"] ?? "";

    RoomUpdate($id, $hotel_id, $room_type_id, $room_number, $price);
    exit();
}

// for edit mode
if (isset($_POST["edit"]) && isset($_POST["room-id"])) {
    $editingId = $_POST["room-id"];
}

// cancel edit mode
if (isset($_POST["cancel"])) {
    $editingId = null;
}
?>

<body onload="loadNavbar()">
    <div id="navbar-container"></div> <!-- Navbar will be loaded here -->
    <div class="main_content">
        <section class="add-container">
            <div class="heading-row">
                <h2>Room List</h2>
                <a class="add-btn" href="room-add.php">Add Room</a>
            </div>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search by Hotel, Room ID or Number..."
                    autocomplete="off" onkeyup="filterRoomList(this)">
            </div>
            <table class="base-table">
                <thead>
                    <tr>
                        <th>Hotel</th>
                        <th>Room ID</th>
                        <th>Room Type</th>
                        <th>Room Number</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php RoomList($editingId) ?>
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