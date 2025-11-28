<?php
require_once("functions.php");

$admin = GetAdminUser();

$adminEmail = $admin['USER_EMAIL'];

// first name + starting letter of last name
$adminName = $admin
    ? trim($admin['F_NAME'] . ' ' . strtoupper(substr($admin['L_NAME'], 0, 1)))
    : 'Admin User';

$adminUsername = $admin
    ? $admin['USERNAME']
    : 'admin';
?>


<!-- top navigation -->
<header class="top-nav">
    <div>S&M Hotels</div>
    <div class="top-menu">
        <div class="profile">
            <a href="mailto:<?= htmlspecialchars($adminEmail) ?>" class="contact">
                <?= htmlspecialchars($adminEmail) ?>
            </a>
            <img src="./img/profile-logo.jpg" alt="Profile">
            <span><?= htmlspecialchars($adminName) ?></span>
        </div>

    </div>
</header>
<!-- side navigation -->
<aside class="sidebar">
    <nav>
        <ul>
            <li class="section">My Account</li>
            <li><?= htmlspecialchars($adminUsername) ?></li>
            <br /><br />
            <li class="section">Management</li>
            <li><a href="booking.php">Manage Booking</a></li> <!-- done -->
            <li><a href="hotel.php">Manage Hotel</a></li> <!-- done -->
            <li><a href="room-type.php">Manage Room Type</a></li> <!-- done -->
            <li><a href="room.php">Manage Room</a></li> <!-- done -->
            <li><a href="guest.php">Manage Guest</a></li> <!-- created -->
        </ul>
        <a href="logout.php" class="footer">Sign Out</a>

    </nav>
</aside>