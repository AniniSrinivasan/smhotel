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

$action_error_message = "";
$editingId = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST["add"])) {
        $type = $_POST["room-type-name"];
        $description = $_POST["room-type-desc"];
        RoomTypeInsert($type, $description, $action_error_message);
    }

}
?>

<body onload="loadNavbar()">
    <div id="navbar-container"></div> <!-- Navbar will be loaded here -->
    <div class="main_content">
        <section class="add-container">
        <?php showAlertMessage($action_error_message ?? ""); ?>
            <h2>Add Room Type</h2>
            <div class="base-form">
                <form autocomplete="off" method="post">
                    <div class="base-form">
                        <div>
                            <label for="room-type-name"> Room Type Name: </label>
                            <input type="text" id="room-type-name"  placeholder="Room Type Name" name="room-type-name" required>
                        </div>
                        <div>
                            <label for="room-type-desc"> Room Type Description: </label>
                            <input type="text" id="room-type-desc"  placeholder="Room Type Description" name="room-type-desc" required>
                        </div>
                        <input type="submit" class="submit-btn" name="add" value="Add">
                        <div class="base-form">
                </form>
            </div>
        </section>
    </div>
</body>

</html>