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
    $fname = $_POST["fname"] ?? "";
    $mname = $_POST["mname"] ?? "";
    $lname = $_POST["lname"] ?? "";
    $address = $_POST["address"] ?? "";
    $city = $_POST["city"] ?? "";
    $postcode = $_POST["postcode"] ?? "";
    $email = $_POST["email"] ?? "";
    $phone = $_POST["phone"] ?? "";

    $errormessage = GuestInsert($fname, $mname, $lname, $address, $city, $postcode, $email, $phone);
}
?>

<body onload="loadNavbar()">

    <div id="navbar-container"></div> <!-- Navbar will be loaded here -->

    <div class="main_content">
        <section class="add-container">

            <?php showAlertMessage($errormessage ?? ""); ?>

            <h2>Add Guest</h2>

            <form autocomplete="off" method="post">
                <div class="base-form">

                    <div class="name-group">
                        <div>
                            <label for="fname">First Name:</label>
                            <input type="text" id="fname" name="fname" placeholder="First Name" required>
                        </div>
                        <div>
                            <label for="mname">Middle Name:</label>
                            <input type="text" id="mname" name="mname" placeholder="Middle Name">
                        </div>
                        <div>
                            <label for="lname">Last Name:</label>
                            <input type="text" id="lname" name="lname" placeholder="Last Name" required>
                        </div>
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
                        <label for="phone">Phone Number: </label>
                        <input type="text" placeholder="Phone Number" name="phone" required>
                    </div>
                    <input type="submit" class="submit-btn" name="add" value="Add">
                </div>
            </form>

        </section>
    </div>

</body>

</html>