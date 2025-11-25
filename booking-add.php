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

    if (isset($_POST['add'])) {
        $room_id = $_POST['room-id'] ?? '';
        $guest_id = $_POST['guest-id'] ?? '';
        $num_guest = $_POST['num-guest'] ?? '';
        $dateIn = $_POST['date-in'] ?? '';
        $dateOut = $_POST['date-out'] ?? '';
        BookingInsert($room_id, $guest_id, $num_guest, $dateIn, $dateOut);
    }

    if (isset($_POST['delete']) && isset($_POST['booking-id'])) {
        $id = $_POST['booking-id'];
        BookingDelete($id);   // assuming you already have this
        exit;
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
        exit;
    }

    // for edit mode
    if (isset($_POST['edit']) && isset($_POST['booking-id'])) {
        $editingId = $_POST['booking-id'];
    }

    // Cancel edit mode
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

            <h2>Add Booking</h2>


            <h2><?= htmlspecialchars(string: $errormessage) ?></h2>
            <form autocomplete="off" method="post">
                <div class="group">
                    <label for="date-in">Check In: </label>
                    <input type="date" id="date-in" name="date-in" value="<?= htmlspecialchars($dateIn) ?>" required>
                </div>
                <br />
                <div class="group">
                    <label for="date-out">Check Out: </label>
                    <input type="date" id="date-out" name="date-out" value="<?= htmlspecialchars($dateOut) ?>" required>
                </div>
                <br />
                <div class="group">
                    <label for="hotel-id">Hotel Branch: </label>
                    <?php HotelDropdown('hotel-id', $selectedHotelId); ?>
                </div>
                <br />
                <div class="group">
                    <label for="guest-id">Guest: </label>
                    <?php GuestDropdown('guest-id'); ?>
                </div>
                <br />
                <div class="group">
                    <label for="num-guest">Number of Guest: </label>
                    <input type="number" placeholder="Number of Guest" name="num-guest" min="1" max="4" required>
                </div>
                <br />

                <div>
                    <label for="room-id">Room ID: </label>
                    <?php RoomDropdown('room-id', null, $dateIn, $dateOut, $selectedHotelId); ?>
                </div>
                <br/>
                <input type="submit" class="submit-btn" name="add" value="Add">

            </form>
        </section>
    </div>





</body>

</html>