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

$errormessage = "";
$editingId = null;

// add (inserts a new room)
if (isset($_POST["add"])) {
    $room_type_id = $_POST["room-type-id"] ?? "";
    $room_number  = $_POST["room-number"]   ?? "";
    $price        = $_POST["room-price"]    ?? "";
    $hotel_id     = $_POST["hotel-id"]      ?? "";

    $errormessage = RoomInsert($room_type_id, $room_number, $price, $hotel_id);
}

// delete (removes the room)
if (isset($_POST["delete"]) && isset($_POST["room-id"])) {
    $id = $_POST["room-id"];
    RoomDelete($id);
    exit();
}

// save (updates the existing)
if (isset($_POST["save"]) && isset($_POST["room-id"])) {
    $id           = $_POST["room-id"];
    $hotel_id     = $_POST["hotel-id"]      ?? "";
    $room_type_id = $_POST["room-type-id"] ?? "";
    $room_number  = $_POST["room-number"]   ?? "";
    $price        = $_POST["room-price"]    ?? "";

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
            <h2>Add Room</h2>
            <h2><?= htmlspecialchars(string: $errormessage) ?></h2>
            <form autocomplete="off" method="post">
                <div class="base-form">
                    <div>
                        <label for="hotel-id">Hotel ID: </label>
                        <input type="number" placeholder="Room Number" name="hotel-id" required>
                    </div>
                    <div>
                        <label for="room-type-id">Room Type ID: </label>
                        <input type="number" placeholder="Room Number" name="room-type-id" required>
                    </div>
                    <div>
                        <label for="room-number">Room Number: </label>
                        <input type="number" placeholder="Room Number" name="room-number" required>
                    </div>
                    <div>
                        <label for="room-price">Price: </label>
                        <input type="text" placeholder="Price" name="room-price" required>
                    </div>
                    <input type="submit" class="submit-btn" name="add" value="Add">
                </div>
            </form>
            </section>

            <br /> <br />

            <section class="add-container">
            <h2>Room List</h2>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search by Room ID or Number..." autocomplete="off"
                    onkeyup="filterRoomList(this)">
            </div>
            <table class="base-table">
                <thead>
                    <tr>
                        <th>Hotel ID</th>
                        <th>Room ID</th>
                        <th>Room Type</th>
                        <th>Room Number</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php RoomList($editingId)?>
                </tbody>
            </table>
        </section>
    </div>


</body>

</html>