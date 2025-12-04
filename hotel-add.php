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
requireLogin();

$action_error_message = "";
$editingId = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST["add"])) {
        $branch = $_POST["branch"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $postcode = $_POST["postcode"];
        $email = $_POST["email"];
        $phone = $_POST["tel-no"];

        HotelInsert($branch, $address, $city, $postcode, $email, $phone, $action_error_message);
    }

}
?>

<body onload="loadNavbar()">
    <div id="navbar-container"></div> <!-- Navbar will be loaded here -->
    <div class="main_content">
        <section class="add-container">
        <?php showAlertMessage($action_error_message ?? ""); ?>
            <h2>Add Hotel</h2>
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
    </div>
</body>

</html>