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
if (isset($_POST["add"])) {
    $room_id = $_POST["room-id"];
    $guest_id = $_POST["guest-id"];
    $num_guest = $_POST["num-guest"];
    $dateIn  = $_POST['date-in'];
    $dateOut = $_POST['date-out'];    
    $errormessage = BookingInsert($room_id, $guest_id, $num_guest, $dateIn, $dateOut);
}
if (isset($_POST["delete"])) {
    $id = $_POST["booking-id"];
    BookingDelete($id);
}
?>

<body onload="loadNavbar()">


    <div id="navbar-container"></div> <!-- Navbar will be loaded here -->

    <div class="main_content">
        <section class="list-container">
            <h2>Booking List</h2>

            <h2><?= htmlspecialchars(string: $errormessage) ?></h2>
            <form autocomplete="off" method="post">
                <div class="base-form">
                    <div>
                        <label for="room-id">Room ID: </label>
                        <input type="number" placeholder="Room ID" name="room-id" required>
                    </div>
                    <div>
                        <label for="guest-id">Guest ID: </label>
                        <input type="number" placeholder="Guest ID" name="guest-id" required>
                    </div>
                    <div>
                        <label for="num-guest">Number of Guest: </label>
                        <input type="number" placeholder="Number of Guest" name="num-guest" required>
                    </div>
                    <div>
                        <label for="date-in">Check In: </label>
                        <input type="date" name="date-in" required>
                    </div>
                    <div>
                        <label for="date-out">Check Out: </label>
                        <input type="date" name="date-out" required>
                    </div>
                    <input type="submit" class="submit-btn" name="add" value="Add">
                </div>
            </form>
            <br /> <br /> <br /> <br />

            <table class="base-table">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Guest ID</th>
                        <th>Room ID</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Number of Guests</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php BookingList() ?>
                </tbody>
            </table>
        </section>
    </div>


</body>

</html>