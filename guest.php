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
requireLogin();

$errormessage = "";
$editingId = null;

// delete (removes the guest)
if (isset($_POST["delete"]) && isset($_POST["guest-id"])) {
    $id = $_POST["guest-id"];
    GuestDelete($id);
}

// save (updates the existing)
if (isset($_POST["save"]) && isset($_POST["guest-id"])) {
    $id = $_POST["guest-id"];
    $fname = $_POST["fname"] ?? "";
    $mname = $_POST["mname"] ?? "";
    $lname = $_POST["lname"] ?? "";
    $address = $_POST["address"] ?? "";
    $city = $_POST["city"] ?? "";
    $postcode = $_POST["postcode"] ?? "";
    $email = $_POST["email"] ?? "";
    $phone = $_POST["phone"] ?? "";

    GuestUpdate($id, $fname, $mname, $lname, $address, $city, $postcode, $email, $phone);
}

// for edit mode
if (isset($_POST["edit"]) && isset($_POST["guest-id"])) {
    $editingId = $_POST["guest-id"];
}

// Cancel edit mode
if (isset($_POST["cancel"])) {
    $editingId = null;
}
?>

<body onload="loadNavbar()">
    <div id="navbar-container"></div> <!-- Navbar will be loaded here -->
    <div class="main_content">
        <section class="add-container">
            <div class="heading-row">
                <h2>Guest List</h2>
                <a class="add-btn" href="guest-add.php">Add Guest</a>
            </div>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search by Guest ID or Name..." autocomplete="off"
                    onkeyup="filterHotelList(this)">
            </div>
            <table class="base-table">
                <thead>
                    <tr>
                        <th>Guest ID</th>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Postcode</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php GuestList($editingId) ?>
                </tbody>
            </table>
            <br />
            <ul class="pagination">
                <li><a href="#">&laquo;</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </section>
    </div>
</body>

</html>