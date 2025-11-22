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


if (isset($_POST["add"])) {
    $branch   = $_POST["branch"];
    $address  = $_POST["address"];
    $city     = $_POST["city"];
    $postcode = $_POST["postcode"];
    $email    = $_POST["email"];
    $phone    = $_POST["tel-no"];

    $errormessage = HotelInsert($branch, $address, $city, $postcode, $email, $phone);
}


if (isset($_POST["delete"]) && isset($_POST["hotel-id"])) {
    $id = $_POST["hotel-id"];
    HotelDelete($id);
    exit();
}

// save (updates the existing)
if (isset($_POST["save"]) && isset($_POST["hotel-id"])) {
    $id       = $_POST["hotel-id"];
    $city     = $_POST["city"]     ?? "";
    $postcode = $_POST["postcode"] ?? "";
    $address  = $_POST["address"]  ?? "";
    $email    = $_POST["email"]    ?? "";
    $phone    = $_POST["tel-no"]   ?? "";

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
            <h2>Add Hotel</h2>

            <h2><?= htmlspecialchars(string: $errormessage) ?></h2>
            <form autocomplete="off" method="post">
                <div class="base-form">
                    <div>
                        <label for="branch">Branch Name: </label>
                        <input type="text" placeholder="Branch Name" name="branch" required>
                    </div>
                    <div>
                        <label for="address">Address: </label>
                        <input type="text" placeholder="Address" name="address" required>
                    </div>
                    <div>
                        <label for="city">City: </label>
                        <input type="text" placeholder="City" name="city" required>
                    </div>
                    <div>
                        <label for="postcode">Postcode: </label>
                        <input type="text" placeholder="Postcode" name="postcode" required>
                    </div>
                    <div>
                        <label for="email">Email: </label>
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <div>
                        <label for="tel-no">Telephone Number: </label>
                        <input type="text" placeholder="Phone number" name="tel-no" required>
                    </div>
                    <input type="submit" class="submit-btn" name="add" value="Add">
                </div>
            </form>
            </section>
            <br /> <br /> 

            <section class="add-container">
            <h2>Hotel List</h2>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search by Hotel ID or Branch Name..." autocomplete="off"
                    onkeyup="filterHotelList(this)">
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
                    <?php HotelList($editingId)?>
                </tbody>
            </table>
        </section>
    </div>


</body>

</html>