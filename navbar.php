<!-- Artificial Intelligence (AI) has not been used for any part of the activity.  -->
<?php
require_once("functions.php");

session_start();

$email = $_SESSION["EMAIL"];
$username = $_SESSION["USERNAME"];
$role = $_SESSION["ROLE"];
?>

<!-- top navigation -->
<header class="top-nav">
    <div>S&M Hotels</div>
    <div class="top-menu">
        <div class="profile">
            <a href="mailto:<?= htmlspecialchars($email) ?>" class="contact">
                <?= htmlspecialchars($email) ?>
            </a>
            <img src="./img/profile-logo.jpg" alt="Profile">
            <span><?= htmlspecialchars($username) ?></span>
        </div>
    </div>
</header>
<!-- side navigation -->
<aside class="sidebar">
    <nav>
        <ul>
            <li class="section">My Account</li>
            <li><?= htmlspecialchars($role) ?></li>
            <br /><br />
            <li class="section">Management</li>
            <li><a href="booking.php">Manage Booking</a></li>
            <!-- using session to display based on their role, below displayed only for admin -->
            <?php if (isset($_SESSION['ROLE']) && $_SESSION['ROLE'] === 'Admin'): ?> 
                <li><a href="hotel.php">Manage Hotel</a></li>
                <li><a href="room-type.php">Manage Room Type</a></li>
                <li><a href="room.php">Manage Room</a></li>
                <li><a href="guest.php">Manage Guest</a></li>
            <?php endif; ?>
        </ul>
        <a href="logout.php" class="logout">Sign Out</a>
    </nav>
</aside>