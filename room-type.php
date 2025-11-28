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

$action_message = "";
$action_error_message = "";
$editingId = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

    <div id="message">
        <h3><?= $action_message ?></h3>
    </div>

    <div id="error-message"><?= $action_error_message ?></div>

    <div class="main_content">
        <section class="add-container">
            <div class="heading-row">
                <h2>Room Type List</h2>
                <a class="add-btn" href="room-type-add.php">Add Room Type</a>
            </div>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search by Room Type ID or Room Type Name..."
                    autocomplete="off" onkeyup="filterRoomTypeList(this)">
            </div>
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