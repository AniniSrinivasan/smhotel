<?php

function createDB()
{
    $db = new SQLite3('hotelSQL.db');
    $db->exec("PRAGMA foreign_keys = ON");
    return $db;
}

function validateUser($username, $password, &$error)
{

    $db = createDB();
    $result = $db->query("SELECT * FROM USER WHERE USERNAME = '$username'");
    $row = $result->fetchArray(SQLITE3_ASSOC);

    if ($row) {
        if ($row['USER_PASSWORD'] === $password) {
            return $row;
        } else {
            $error = "Invalid password.";
            return false;
        }
    } else {
        $error = "User not found.";
        return false;
    }
}

function GetAdminUser()
{
    $db = createDB();

    $sql = "SELECT F_NAME, M_NAME, L_NAME, USER_EMAIL, USERNAME 
            FROM USER 
            WHERE ROLE = 'Admin'";

    $row = $db->querySingle($sql, true);

    return $row;
}

function BookingInsert($room_id, $guest_id, $num_guest, $dateIn, $dateOut)
{
    $error = "";
    $db = createDB();
    $insert = $db->exec("INSERT INTO BOOKING (NO_OF_GUEST, DATE_IN, DATE_OUT, GUEST_ID, ROOM_ID) VALUES ('$num_guest', '$dateIn', '$dateOut', '$guest_id', '$room_id')");
    if ($insert) {
        // header("Location: dashboard.php");
    } else {
        $error = "Error in inserting room " . $db->lastErrorMsg() . "<br>";
    }
    return $error;
}

function BookingList($editingId = null)
{
    $db = createDB();

    $select_query = "SELECT * FROM BOOKING";
    $result = $db->query($select_query);

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {

        // If this row is in edit mode then it'll proceed to go into the input mode for the admin to edit
        if ($editingId == $row['BOOKING_ID']) {

            echo "<form method='post'><tr>";

            // Booking ID is not editable
            echo "<td>" . $row['BOOKING_ID'] . "</td>";

            // Hidden ID for save
            echo "<input type='hidden' name='booking-id' value='" . $row['BOOKING_ID'] . "'>";

            // ROOM_ID
            echo "<td>
                    <input type='number' name='room-id'
                           value='" . htmlspecialchars($row['ROOM_ID']) . "' required>
                  </td>";

            // GUEST_ID
            echo "<td>
                    <input type='number' name='guest-id'
                           value='" . htmlspecialchars($row['GUEST_ID']) . "' required>
                  </td>";

            // DATE_IN
            echo "<td>
                    <input type='date' name='date-in'
                           value='" . htmlspecialchars($row['DATE_IN']) . "' required>
                  </td>";

            // DATE_OUT
            echo "<td>
                    <input type='date' name='date-out'
                           value='" . htmlspecialchars($row['DATE_OUT']) . "' required>
                  </td>";

            // NO_OF_GUEST
            echo "<td>
                    <input type='number' name='num-guest'
                           value='" . htmlspecialchars($row['NO_OF_GUEST']) . "' required>
                  </td>";

            // Actions: Save / Cancel
            echo "<td>
                    <input type='submit' class='submit-btn' name='save' value='Save'>
                    <input type='submit' class='delete-button-in-list' name='cancel' value='Cancel'>
                  </td>";

            echo "</tr></form>";

        } else {

            // Normal view row
            echo "<form method='post'><tr>";

            echo "<td>" . $row['BOOKING_ID'] . "</td>";
            echo "<td>" . $row['ROOM_ID'] . "</td>";
            echo "<td>" . $row['GUEST_ID'] . "</td>";
            echo "<td>" . $row['DATE_IN'] . "</td>";
            echo "<td>" . $row['DATE_OUT'] . "</td>";
            echo "<td>" . $row['NO_OF_GUEST'] . "</td>";

            echo "<td>
                    <input type='hidden' name='booking-id' value='" . $row['BOOKING_ID'] . "'>
                    <input type='submit' class='edit-button-in-list' name='edit' value='Edit'>
                    <input type='submit' class='delete-button-in-list' name='delete' value='Delete'>
                  </td>";

            echo "</tr></form>";
        }
    }
}

function BookingUpdate($booking_id, $room_id, $guest_id, $num_guest, $dateIn, $dateOut)
{
    $db = createDB();

    $update = $db->exec("UPDATE BOOKING 
                         SET ROOM_ID     = '$room_id',
                             GUEST_ID    = '$guest_id',
                             NO_OF_GUEST = '$num_guest',
                             DATE_IN     = '$dateIn',
                             DATE_OUT    = '$dateOut'
                         WHERE BOOKING_ID = '$booking_id'");

    if ($update) {
        // header("Location: booking.php");
        exit();
    } else {
        echo 'Error in updating booking ' . $db->lastErrorMsg() . '<br>';
    }
}


function BookingDelete($id)
{
    $db = createDB();

    $delete = $db->exec("DELETE FROM BOOKING WHERE BOOKING_ID = '$id'");

    if ($delete) {
        // header("Location: dashboard.php");
        // exit();
    } else {
        echo "Error deleting room type: " . $db->lastErrorMsg();
    }
}

function HotelInsert($branch, $address, $city, $postcode, $email, $phone)
{
    $error = "";
    $db = createDB();
    $insert = $db->exec("INSERT INTO HOTEL (HOTEL_NAME, HOTEL_ADDRESS, CITY, POSTCODE, HOTEL_TELNO, HOTEL_EMAIL) VALUES ('$branch', '$address', '$city', '$postcode', '$phone', '$email')");
    if ($insert) {
        // header("Location: dashboard.php");
    } else {
        $error = "Error in inserting room " . $db->lastErrorMsg() . "<br>";
    }
    return $error;
}

function HotelDropdown($fieldName = 'hotel-id', $selectedId = null)
{
    $db = createDB();

    $sql = "SELECT HOTEL_ID, HOTEL_NAME, CITY FROM HOTEL ORDER BY HOTEL_NAME";
    $result = $db->query($sql);

    echo "<select name='{$fieldName}' id='{$fieldName}' required>";
    echo "<option value=''>-- Select Hotel Name--</option>";

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $id = (int) $row['HOTEL_ID'];
        $name = htmlspecialchars($row['HOTEL_NAME']);
        $city = htmlspecialchars($row['CITY']);

        $label = "{$name} ({$city})";
        $selected = ($selectedId == $id) ? "selected" : "";

        echo "<option value='{$id}' {$selected}>{$label}</option>";
    }

    echo "</select>";
}


function HotelList($editingId = null)
{
    $db = createDB();

    $select_query = "SELECT * FROM HOTEL";
    $result = $db->query($select_query);

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {

        // === EDIT MODE ROW ===
        if ($editingId == $row['HOTEL_ID']) {

            echo "<form method='post'><tr>";

            // Hotel ID (not editable)
            echo "<td>" . $row['HOTEL_ID'] . "</td>";
            echo "<input type='hidden' name='hotel-id' value='" . $row['HOTEL_ID'] . "'>";

            // Branch column – you are currently showing CITY here
            echo "<td>
                    <input type='text' name='city'
                           value='" . htmlspecialchars($row['CITY']) . "' required>
                  </td>";

            // Postcode / Address / Email / Phone
            echo "<td>
                    <input type='text' name='postcode'
                           value='" . htmlspecialchars($row['POSTCODE']) . "' required>
                  </td>";

            echo "<td>
                    <input type='text' name='address'
                           value='" . htmlspecialchars($row['HOTEL_ADDRESS']) . "' required>
                  </td>";

            echo "<td>
                    <input type='email' name='email'
                           value='" . htmlspecialchars($row['HOTEL_EMAIL']) . "' required>
                  </td>";

            echo "<td>
                    <input type='text' name='tel-no'
                           value='" . htmlspecialchars($row['HOTEL_TELNO']) . "' required>
                  </td>";

            // Actions: Save / Cancel
            echo "<td>
                    <input type='submit' class='submit-btn' name='save' value='Save'>
                    <input type='submit' class='delete-button-in-list' name='cancel' value='Cancel'>
                  </td>";

            echo "</tr></form>";

        } else {
            // === NORMAL VIEW ROW ===

            echo "<form method='post'><tr>";
            echo "<td>" . $row['HOTEL_ID'] . "</td>";
            echo "<td>" . $row['CITY'] . "</td>";
            echo "<td>" . $row['POSTCODE'] . "</td>";
            echo "<td>" . $row['HOTEL_ADDRESS'] . "</td>";
            echo "<td>" . $row['HOTEL_EMAIL'] . "</td>";
            echo "<td>" . $row['HOTEL_TELNO'] . "</td>";

            echo "<td>
                    <input type='hidden' name='hotel-id' value='" . $row['HOTEL_ID'] . "'>
                    <input type='submit' class='edit-button-in-list' name='edit' value='Edit'>
                    <input type='submit' class='delete-button-in-list' name='delete' value='Delete'>
                  </td>";

            echo "</tr></form>";
        }
    }
}

function HotelUpdate($id, $city, $address, $postcode, $email, $phone)
{
    $db = createDB();

    $update = $db->exec("UPDATE HOTEL 
                         SET CITY          = '$city',
                             HOTEL_ADDRESS = '$address',
                             POSTCODE      = '$postcode',
                             HOTEL_EMAIL   = '$email',
                             HOTEL_TELNO   = '$phone'
                         WHERE HOTEL_ID   = '$id'");

    if ($update) {
        // header("Location: hotel.php");
        // exit();
    } else {
        echo "Error in updating hotel " . $db->lastErrorMsg() . "<br>";
    }
}


function HotelDelete($id)
{
    $db = createDB();

    $delete = $db->exec("DELETE FROM HOTEL WHERE HOTEL_ID = '$id'");

    if ($delete) {
        // header("Location: dashboard.php");
        // exit();
    } else {
        echo "Error deleting room type: " . $db->lastErrorMsg();
    }
}

function RoomTypeInsert($type, $description, &$action_message, &$action_error_message)
{
    $db = createDB();
    $insert = $db->exec("INSERT INTO ROOM_TYPE (ROOM_TYPE_NAME, ROOM_TYPE_DESCRIPTION) VALUES ('$type','$description')");
    if ($insert) {
        $action_message = "Room Type Added Successfully!!";
        //echo $action_message;
    } else {
        $action_error_message = "Error in inserting room type " . $db->lastErrorMsg() . "<br>";
        //echo $action_error_message;
    }
}

function RoomTypeDropdown($fieldName = 'room-type-id', $selectedId = null)
{
    $db = createDB();

    $sql = "SELECT ROOM_TYPE_ID, ROOM_TYPE_NAME FROM ROOM_TYPE ORDER BY ROOM_TYPE_NAME";
    $result = $db->query($sql);

    echo "<select name='{$fieldName}' id='{$fieldName}' required>";
    echo "<option value=''>-- Select Room Type Name--</option>";

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $id = (int) $row['ROOM_TYPE_ID'];
        $name = htmlspecialchars($row['ROOM_TYPE_NAME']);

        $selected = ($selectedId == $id) ? "selected" : "";
        echo "<option value='{$id}' {$selected}>{$name}</option>";
    }

    echo "</select>";
}


function RoomTypeList($editingId = null)
{
    $db = createDB();

    $select_query = "SELECT * FROM ROOM_TYPE";
    $result = $db->query($select_query);

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {

        // if edit mode chosen
        if ($editingId == $row['ROOM_TYPE_ID']) {

            echo "<form method='post'><tr>";
            echo "<td>" . $row['ROOM_TYPE_ID'] . "</td>";

            // pre-filled edit mode
            echo "<td>
                    <input type='hidden' name='room-type-id' value='" . $row['ROOM_TYPE_ID'] . "'>
                    <input type='text' name='room-type-name' value='" . htmlspecialchars($row['ROOM_TYPE_NAME']) . "' required>
                  </td>";
            echo "<td>
                    <input type='text' name='room-type-desc' value='" . htmlspecialchars($row['ROOM_TYPE_DESCRIPTION']) . "' required>
                  </td>";

            echo "<td>
                    <input type='submit' class='submit-btn' name='save' value='Save'>
                    <input type='submit' class='delete-button-in-list' name='cancel' value='Cancel'>
                  </td>";
            echo "</tr></form>";

        } else {

            // view only
            echo "<form method='post'><tr>";
            echo "<td>" . $row['ROOM_TYPE_ID'] . "</td>";
            echo "<td>" . $row['ROOM_TYPE_NAME'] . "</td>";
            echo "<td>" . $row['ROOM_TYPE_DESCRIPTION'] . "</td>";

            echo "<td>
                    <input type='hidden' name='room-type-id' value='" . $row['ROOM_TYPE_ID'] . "'>
                    <input type='submit' class='edit-button-in-list' name='edit' value='Edit'>
                    <input type='submit' class='delete-button-in-list' name='delete' value='Delete'>
                  </td>";
            echo "</tr></form>";
        }
    }
}

function RoomTypeUpdate($id, $type, $description)
{
    $db = createDB();

    $update = $db->exec("UPDATE ROOM_TYPE 
                         SET ROOM_TYPE_NAME = '$type',
                             ROOM_TYPE_DESCRIPTION = '$description'
                         WHERE ROOM_TYPE_ID = '$id'");

    if ($update) {

    } else {
        echo "Error in updating room type " . $db->lastErrorMsg() . "<br>";
    }
}


function RoomTypeDelete($id)
{
    $db = createDB();

    $delete = $db->exec("DELETE FROM ROOM_TYPE WHERE ROOM_TYPE_ID = '$id'");

    if ($delete) {

    } else {
        echo "Error deleting room type: " . $db->lastErrorMsg();
    }
}



function RoomInsert($room_type_id, $room_number, $price, $hotel_id)
{
    $error = "";
    $db = createDB();
    $insert = $db->exec("INSERT INTO ROOM (ROOM_NO, ROOM_TYPE_ID, PRICE, HOTEL_ID) VALUES ($room_number,$room_type_id,$price,$hotel_id)");
    if ($insert) {
        header("Location: room.php");
    } else {
        $error = "Error in inserting room " . $db->lastErrorMsg() . "<br>";
    }
    return $error;
}

function RoomDropdown($fieldName = 'room-id', $selectedId = null)
{
    $db = createDB();

    $sql = "SELECT ROOM_ID FROM ROOM ORDER BY ROOM_ID";
    $result = $db->query($sql);

    echo "<select name='{$fieldName}' id='{$fieldName}' required>";
    echo "<option value=''>-- Select Room ID --</option>";

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $id = (int) $row['ROOM_ID'];

        $label = "{$id}";
        $selected = ($selectedId == $id) ? "selected" : "";

        echo "<option value='{$id}' {$selected}>{$label}</option>";
    }

    echo "</select>";
}

function RoomList($editingId = null)
{
    $db = createDB();

    $select_query = "SELECT * FROM ROOM";
    $result = $db->query($select_query);

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {

        if ($editingId == $row['ROOM_ID']) {

            echo "<form method='post'><tr>";

            echo "<td>
                    <input type='number' name='hotel-id'
                           value='" . htmlspecialchars($row['HOTEL_ID']) . "' required>
                  </td>";

            echo "<td>" . $row['ROOM_ID'] . "</td>";
            echo "<input type='hidden' name='room-id' value='" . $row['ROOM_ID'] . "'>";

            echo "<td>
                    <input type='number' name='room-type-id'
                           value='" . htmlspecialchars($row['ROOM_TYPE_ID']) . "' required>
                  </td>";

            echo "<td>
                    <input type='number' name='room-number'
                           value='" . htmlspecialchars($row['ROOM_NO']) . "' required>
                  </td>";

            echo "<td>
                    <input type='number' step='0.01' name='room-price'
                           value='" . htmlspecialchars($row['PRICE']) . "' required>
                  </td>";

            echo "<td>
                    <input type='submit' class='submit-btn' name='save' value='Save'>
                    <input type='submit' class='delete-button-in-list' name='cancel' value='Cancel'>
                  </td>";

            echo "</tr></form>";

        } else {

            // normal view row
            echo "<form method='post'><tr>";
            echo "<td>" . $row['HOTEL_ID'] . "</td>";
            echo "<td>" . $row['ROOM_ID'] . "</td>";
            echo "<td>" . $row['ROOM_TYPE_ID'] . "</td>";
            echo "<td>" . $row['ROOM_NO'] . "</td>";
            echo "<td>" . $row['PRICE'] . "</td>";
            echo "<td>
                    <input type='hidden' name='room-id' value='" . $row['ROOM_ID'] . "'>
                    <input type='submit' class='edit-button-in-list' name='edit' value='Edit'>
                    <input type='submit' class='delete-button-in-list' name='delete' value='Delete'>
                  </td>";
            echo "</tr></form>";
        }
    }
}

function RoomUpdate($room_id, $hotel_id, $room_type_id, $room_number, $price)
{
    $db = createDB();

    $update = $db->exec("UPDATE ROOM 
                         SET HOTEL_ID    = '$hotel_id',
                             ROOM_TYPE_ID = '$room_type_id',
                             ROOM_NO      = '$room_number',
                             PRICE        = '$price'
                         WHERE ROOM_ID   = '$room_id'");

    if ($update) {
        // header("Location: room.php");
        // exit();
    } else {
        echo "Error in updating room " . $db->lastErrorMsg() . "<br>";
    }
}


function RoomDelete($id)
{
    $db = createDB();

    $delete = $db->exec("DELETE FROM ROOM WHERE ROOM_ID = '$id'");

    if ($delete) {
        // header("Location: dashboard.php");
        // exit();
    } else {
        echo "Error deleting room type: " . $db->lastErrorMsg();
    }
}

function GuestAdd($fname, $mname, $lname, $address, $city, $postcode, $email, $phone)
{
    $error = "";
    $db = createDB();
    $insert = $db->exec("INSERT INTO GUEST (F_NAME, M_NAME, L_NAME, GUEST_ADDRESS, CITY, POSTCODE, GUEST_EMAIL, GUEST_PHNO) VALUES ('$fname', '$mname', '$lname', '$address', '$city', '$postcode', '$email', '$phone')");
    if ($insert) {
        // header("Location: dashboard.php");
    } else {
        $error = "Error in inserting room " . $db->lastErrorMsg() . "<br>";
    }
    return $error;
}

function GuestDropdown($fieldName = 'guest-id', $selectedId = null)
{
    $db = createDB();

    $sql = "SELECT GUEST_ID, F_NAME, L_NAME FROM GUEST ORDER BY F_NAME";
    $result = $db->query($sql);

    echo "<select name='{$fieldName}' id='{$fieldName}' required>";
    echo "<option value=''>-- Select Guest Name --</option>";

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $id = (int) $row['GUEST_ID'];
        $fname = htmlspecialchars($row['F_NAME']);
        $lname = htmlspecialchars($row['L_NAME']);

        $label = "[{$id}] {$fname} {$lname}";
        $selected = ($selectedId == $id) ? "selected" : "";

        echo "<option value='{$id}' {$selected}>{$label}</option>";
    }

    echo "</select>";
}


function GuestList($editingId = null)
{
    $db = createDB();

    $select_query = "SELECT * FROM GUEST";
    $result = $db->query($select_query);

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {

        $name = trim($row['F_NAME'] . " " . $row['M_NAME'] . " " . $row['L_NAME']);

        if ($editingId == $row['GUEST_ID']) {

            echo "<form method='post'><tr>";

            echo "<td>" . $row['GUEST_ID'] . "</td>";
            echo "<input type='hidden' name='guest-id' value='" . $row['GUEST_ID'] . "'>";

            echo "<td>
                    <input type='text' name='fname' value='" . htmlspecialchars($row['F_NAME']) . "' required placeholder='First Name'><br>
                    <input type='text' name='mname' value='" . htmlspecialchars($row['M_NAME']) . "' placeholder='Middle Name'><br>
                    <input type='text' name='lname' value='" . htmlspecialchars($row['L_NAME']) . "' required placeholder='Last Name'>
                  </td>";

            echo "<td>
                    <input type='text' name='address'
                           value='" . htmlspecialchars($row['GUEST_ADDRESS']) . "' required>
                  </td>";

            echo "<td>
                    <input type='text' name='city'
                           value='" . htmlspecialchars($row['CITY']) . "' required>
                  </td>";

            echo "<td>
                    <input type='text' name='postcode'
                           value='" . htmlspecialchars($row['POSTCODE']) . "' required>
                  </td>";

            echo "<td>
                    <input type='email' name='email'
                           value='" . htmlspecialchars($row['GUEST_EMAIL']) . "' required>
                  </td>";

            echo "<td>
                    <input type='text' name='phone'
                           value='" . htmlspecialchars($row['GUEST_PHNO']) . "' required>
                  </td>";

            echo "<td>
                    <input type='submit' class='submit-btn' name='save' value='Save'>
                    <input type='submit' class='delete-button-in-list' name='cancel' value='Cancel'>
                  </td>";

            echo "</tr></form>";

        } else {

            // normal view row
            echo "<form method='post'><tr>";
            echo "<td>" . $row['GUEST_ID'] . "</td>";
            echo "<td>" . $name . "</td>";
            echo "<td>" . $row['GUEST_ADDRESS'] . "</td>";
            echo "<td>" . $row['CITY'] . "</td>";
            echo "<td>" . $row['POSTCODE'] . "</td>";
            echo "<td>" . $row['GUEST_EMAIL'] . "</td>";
            echo "<td>" . $row['GUEST_PHNO'] . "</td>";
            echo "<td>
                    <input type='hidden' name='guest-id' value='" . $row['GUEST_ID'] . "'>
                    <input type='submit' class='edit-button-in-list' name='edit' value='Edit'>
                    <input type='submit' class='delete-button-in-list' name='delete' value='Delete'>
                  </td>";
            echo "</tr></form>";
        }
    }
}

function GuestUpdate($id, $fname, $mname, $lname, $address, $city, $postcode, $email, $phone)
{
    $db = createDB();

    $update = $db->exec("UPDATE GUEST 
                         SET F_NAME        = '$fname',
                             M_NAME        = '$mname',
                             L_NAME        = '$lname',
                             GUEST_ADDRESS = '$address',
                             CITY          = '$city',
                             POSTCODE      = '$postcode',
                             GUEST_EMAIL   = '$email',
                             GUEST_PHNO    = '$phone'
                         WHERE GUEST_ID    = '$id'");

    if ($update) {
        // header('Location: guest.php');
        // exit();
    } else {
        echo 'Error updating guest: ' . $db->lastErrorMsg() . '<br>';
    }
}


function GuestDelete($id)
{
    $db = createDB();

    $delete = $db->exec("DELETE FROM GUEST WHERE GUEST_ID = '$id'");

    if ($delete) {
        // header("Location: dashboard.php");
        // exit();
    } else {
        echo "Error deleting room type: " . $db->lastErrorMsg();
    }
}

?>