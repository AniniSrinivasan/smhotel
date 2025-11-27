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
    $room_number = $_POST["room-number"] ?? "";
    $price = $_POST["room-price"] ?? "";
    $hotel_id = $_POST["hotel-id"] ?? "";

    echo "<p>" . $room_type_id . "" . $room_number . "" . $price . "<p>";

    $errormessage = RoomInsert($room_type_id, $room_number, $price, $hotel_id);
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
                        <label for="hotel-id">Hotel Branch: </label>
                        <?php HotelDropdown('hotel-id'); ?>
                        <!-- <input type="number" placeholder="Room Number" name="hotel-id" required> -->
                    </div>
                    <div>
                        <label for="room-type-id">Room Type: </label>
                        <?php RoomTypeDropdown('room-type-id'); ?>
                        <!-- <input type="number" placeholder="Room Number" name="room-type-id" required> -->
                    </div>
                    <div>
                        <label for="room-number">Room Number: </label>
                        <input type="number" placeholder="Room Number" name="room-number" min="1" required>
                    </div>
                    <div>
                        <label for="room-price">Price: </label>
                        <input type="text" placeholder="Price" name="room-price" required>
                    </div>
                    <input type="submit" class="submit-btn" name="add" value="Add">
                </div>
            </form>
        </section>


</body>

</html>