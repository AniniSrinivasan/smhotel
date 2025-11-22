<?php
session_start();

if (!isset($_SESSION['USER_ID'])) {
    header("Location: login.php");
    exit;
}
?>

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


<body class="dashboard-body">
    <!-- top navigation -->
    <header class="top-nav">
        <div>S&M Hotels</div>
        <div class="top-menu">
            <div class="profile">
                <a href="mailto:aninisrini@smh.co.uk" class="contact">aninisrini@smh.co.uk</a>
                <img src="./img/profile-logo.jpg" alt="Profile">
                <span>Anini PS</span>
            </div>
        </div>
    </header>
    <!-- side navigation -->
    <aside class="sidebar">
        <nav>
            <ul>
                <li class="section">My Account</li>
                <li>Anini S</li>
                <li class="section">Management</li>
                <li><a href="booking.php">Manage Booking</a></li> <!-- done -->
                <li><a href="hotel.php">Manage Hotel</a></li> <!-- done -->
                <li><a href="room-type.php">Manage Room Type</a></li> <!-- done -->
                <li><a href="room.php">Manage Room</a></li> <!-- done -->
                <li><a href="guest.php">Manage Guest</a></li> <!-- created -->
            </ul>
        </nav>
    </aside>
    <!-- main content -->
    <main id="main-content" class="main_content">
    <h1>Welcome to S&M Hotels Dashboard</h1>
    <p>Select a menu option to get started.</p>
</main>
    <!-- <main id="main-content" class="main-content">
        <h1>Welcome to S&M Hotels Dashboard</h1>
        <p>Select a menu option to get started.</p>
    </main> -->
</body>

</html>