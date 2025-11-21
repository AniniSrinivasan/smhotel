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
if (isset($_POST["add"])) {
    $hotel_id = $_POST["hotel-id"];
    $room_type_id = $_POST["room-type-id"];
    $room_number = $_POST["room-number"];
    $price = $_POST["room-price"];
    $errormessage = RoomInsert($room_number, $price, $hotel_id, $room_type_id);
}
if (isset($_POST["delete"])) {
    $id = $_POST["room-id"];
    RoomDelete($id);
}
?>

<body onload="loadNavbar()">


    <div id="navbar-container"></div> <!-- Navbar will be loaded here -->

    <div class="main_content">
        <section class="list-container">
            <h2>Room List</h2>
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
            <br /> <br /> <br /> <br />



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
                    <?php RoomList()?>
                </tbody>
            </table>
        </section>
    </div>


</body>

</html>