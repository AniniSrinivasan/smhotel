<!-- Artificial Intelligence (AI) has not been used for any part of the activity.  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S&M Booking</title>
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

$action_error_message = "";
$editingId = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['payment'])) {
        $payment_type = $_POST['payment-type'] ?? '';
        $amount = $_POST['amount'] ?? '';
        $booking_id = $_POST['booking-id'] ?? '';

        PaymentInsert($payment_type, $amount, $booking_id, $action_error_message);
    }
}

$bookingId = (int) $_GET['bookingId'];

if (isset($_GET['bookingId'])) {
    $sql = "
    SELECT 
        b.DATE_IN,
        b.DATE_OUT,
        b.ROOM_ID,
        r.PRICE
    FROM BOOKING b
    INNER JOIN ROOM r ON b.ROOM_ID = r.ROOM_ID
    WHERE b.BOOKING_ID = $bookingId
";

    // reference: https://www.w3schools.com/php/php_date.asp
// total price calculation based on room price and total number of days selected 
    $result = $db->query($sql);
    $row = $result->fetchArray(SQLITE3_ASSOC);
    $dateIn = $row['DATE_IN'];
    $dateOut = $row['DATE_OUT'];
    $roomId = (int) $row['ROOM_ID'];
    $pricePerDay = (float) $row['PRICE'];

    $checkIn = new DateTime($dateIn);
    $checkOut = new DateTime($dateOut);

    $interval = $checkIn->diff($checkOut);
    $daysBooked = $interval->days;

    $totalPrice = $daysBooked * $pricePerDay;

}

?>

<body onload="loadNavbar()">
    <div id="navbar-container"></div> <!-- Navbar will be loaded here -->
    <div class="main_content">
        <section class="add-container">
            <?php showAlertMessage($action_error_message ?? ""); ?>
            <h2>Payment</h2>
            <form autocomplete="off" method="post">
                <div class="group">
                    <label style="font-size: 20px; color: green;" for="amount"> Total Amount to Pay for
                        <?= htmlspecialchars($daysBooked) ?> Day(s) : £<?= htmlspecialchars($totalPrice) ?></label>
                </div>
                <div class="group">
                    <input hidden id="amount" name="amount" value="<?= htmlspecialchars($totalPrice) ?>"></input>
                </div>
                <div class="group">
                    <input hidden id="booking-id" name="booking-id" value="<?= htmlspecialchars($bookingId) ?>"></input>
                </div>
                <br />
                <div class="group">
                    <label for="payment-type">Payment Type</label>
                    <?php PaymentTypeDropdown(); ?>
                </div>
                <br />
                <input type="submit" class="submit-btn" name="payment" value="Complete Payment">
            </form>
        </section>
    </div>
</body>

</html>