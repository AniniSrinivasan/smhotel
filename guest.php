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

$errormessage = "";
$editingId = null;

// add (inserts a new guest)
if (isset($_POST["add"])) {
    $fname    = $_POST["fname"]    ?? "";
    $mname    = $_POST["mname"]    ?? "";
    $lname    = $_POST["lname"]    ?? "";
    $address  = $_POST["address"]  ?? "";
    $city     = $_POST["city"]     ?? "";
    $postcode = $_POST["postcode"] ?? "";
    $email    = $_POST["email"]    ?? "";
    $phone    = $_POST["phone"]    ?? "";

    $errormessage = GuestAdd($fname, $mname, $lname, $address, $city, $postcode, $email, $phone);
}

// delete (removes the guest)
if (isset($_POST["delete"]) && isset($_POST["guest-id"])) {
    $id = $_POST["guest-id"];
    GuestDelete($id);
    exit();
}

// save (updates the existing)
if (isset($_POST["save"]) && isset($_POST["guest-id"])) {
    $id       = $_POST["guest-id"];
    $fname    = $_POST["fname"]    ?? "";
    $mname    = $_POST["mname"]    ?? "";
    $lname    = $_POST["lname"]    ?? "";
    $address  = $_POST["address"]  ?? "";
    $city     = $_POST["city"]     ?? "";
    $postcode = $_POST["postcode"] ?? "";
    $email    = $_POST["email"]    ?? "";
    $phone    = $_POST["phone"]    ?? "";

    GuestUpdate($id, $fname, $mname, $lname, $address, $city, $postcode, $email, $phone);
    exit();
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
            <h2>Add Guest</h2>

            <h2><?= htmlspecialchars(string: $errormessage) ?></h2>

            <form autocomplete="off" method="post">
                <div class="base-form">
                    <div>
                        <label for="fname">First Name: </label>
                        <input type="text" name="fname" required>
                    </div>
                    <div>
                        <label for="mname">Middle Name: </label>
                        <input type="text" name="mname">
                    </div>
                    <div>
                        <label for="lname">Last Name: </label>
                        <input type="text" name="lname" required>
                    </div>
                    <div>
                        <label for="address">Address: </label>
                        <input type="text" name="address" required>
                    </div>
                    <div>
                        <label for="city">City: </label>
                        <input type="text" name="city" required>
                    </div>
                    <div>
                        <label for="postcode">Postcode: </label>
                        <input type="text" name="postcode" required>
                    </div>
                    <div>
                        <label for="email">Email: </label>
                        <input type="email" name="email" required>
                    </div>
                    <div>
                        <label for="ph-no">Phone Number: </label>
                        <input type="text" name="ph-no" required>
                    </div>
                    <input type="submit" class="submit-btn" name="add" value="Add">
                </div>
            </form>

            </section>

            <br /> <br />

            <section class="add-container">
            <h2>Guest List</h2>
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
        </section>
    </div>


</body>

</html>