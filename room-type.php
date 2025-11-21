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

$action_message = "";
$action_error_message = "";
$editingId = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST["add"])) {
        $type = $_POST["room-type-name"];
        $description = $_POST["room-type-desc"];
        RoomTypeInsert($type, $description, $action_message, $action_error_message);
    }

    if (isset($_POST['delete']) && isset($_POST['room-type-id'])) {
        $id = $_POST['room-type-id'];
        RoomTypeDelete($id);
    }

    // save (updates the existing)
    if (isset($_POST['save']) && isset($_POST['room-type-id'])) {
        $id = $_POST['room-type-id'];
        $type = $_POST['room-type-name'] ?? '';
        $description = $_POST['room-type-desc'] ?? '';
        RoomTypeUpdate($id, $type, $description);
    }

    // for edit mode
    if (isset($_POST['edit']) && isset($_POST['room-type-id'])) {
        $editingId = $_POST['room-type-id'];
    }

    // cancel the edit mode
    if (isset($_POST['cancel'])) {
        $editingId = null;
    }
}

?>

<body onload="loadNavbar()">

    <div id="navbar-container"></div> <!-- Navbar will be loaded here -->

    <div id="message"><h3><?= $action_message?></h3></div>
    <div id="error-message"><?= $action_error_message?></div>

    <div class="main_content">
        <section class="add-container">
            <h2>Add Room Type</h2>
           

            <div class="base-form">
                <form autocomplete="off" method="post">
                    <div class="base-form">
                        <div>
                            <label for="room-type-name"> Room Type Name: </label>
                            <input type="text" id="room-type-name" name="room-type-name" required>
                        </div>
                        <div>
                            <label for="room-type-desc"> Room Type Description: </label>
                            <input type="text" id="room-type-desc" name="room-type-desc" required>
                        </div>
                        <input type="submit" class="submit-btn" name="add" value="Add">
                        <div class="base-form">
                </form>
            </div>
        </section>

        <br /><br />
        

        <section class="add-container">
        <h2>Room Type List</h2>
            <table class="base-table">
                <thead>
                    <tr>
                        <th>Room Type ID</th>
                        <th>Room Type Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php RoomTypeList($editingId); ?>
                </tbody>
            </table>
        </section>
    </div>


</body>

</html>