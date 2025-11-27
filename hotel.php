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

if (isset($_POST["delete"]) && isset($_POST["hotel-id"])) {
    $id = $_POST["hotel-id"];
    HotelDelete($id);
    exit();
}

// save (updates the existing)
if (isset($_POST["save"]) && isset($_POST["hotel-id"])) {
    $id = $_POST["hotel-id"];
    $city = $_POST["city"] ?? "";
    $postcode = $_POST["postcode"] ?? "";
    $address = $_POST["address"] ?? "";
    $email = $_POST["email"] ?? "";
    $phone = $_POST["tel-no"] ?? "";

    HotelUpdate($id, $city, $address, $postcode, $email, $phone);
    exit();
}

// for edit mode
if (isset($_POST["edit"]) && isset($_POST["hotel-id"])) {
    $editingId = $_POST["hotel-id"];
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
                <h2>Hotel List</h2>
                <a class="add-btn" href="hotel-add.php">Add Hotel</a>
            </div>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search by Hotel ID or Branch Name..."
                    autocomplete="off" onkeyup="filterHotelList(this)">
            </div>
            <table class="base-table">
                <thead>
                    <tr>
                        <th>Hotel ID</th>
                        <th>Branch</th>
                        <th>Postcode</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php HotelList($editingId) ?>
                </tbody>
            </table>
        </section>
    </div>

    <ul class="pagination">
        <li><a href="#">&laquo;</a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">&raquo;</a></li>
    </ul>

</body>

</html>