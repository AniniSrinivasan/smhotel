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
    require_once "functions.php";
    requireLogin();
?>

<body class="dashboard-body" onload="loadNavbar()">
    <!-- top navigation -->
    <div id="navbar-container"></div> <!-- Navbar will be loaded here -->

    <!-- main content -->
    <main id="main-content" class="main_content">
        <h1>Welcome to S&M Hotels Dashboard</h1>
        <p>Select a menu option to get started.</p>
    </main>
</body>

</html>