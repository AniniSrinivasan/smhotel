<?php

function createDB()
{
    return $db = new SQLite3('hotelSQL.db');
}

function BookingInsert($room_id, $guest_id, $num_guest, $dateIn, $dateOut)
{
    $error = "";
    $db = createDB();
    $insert = $db->exec("INSERT INTO BOOKING (NO_OF_GUEST, DATE_IN, DATE_OUT, GUEST_ID, ROOM_ID) VALUES ('$num_guest', '$dateIn', '$dateOut', '$guest_id', '$room_id')");
    if ($insert) {
        header("Location: dashboard.php");
    } else {
        $error = "Error in inserting room " . $db->lastErrorMsg() . "<br>";
    }
    return $error;
}

function BookingList(){
    $db = createDB();   

    $select_query = "SELECT * FROM BOOKING";
    $result = $db->query($select_query);

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['BOOKING_ID'] . "</td>";
        echo "<td>" . $row['GUEST_ID'] . "</td>";
        echo "<td>" . $row['ROOM_ID'] . "</td>";
        echo "<td>" . $row['DATE_IN'] . "</td>";
        echo "<td>" . $row['DATE_OUT'] . "</td>";
        echo "<td>" . $row['NO_OF_GUEST'] . "</td>";
        echo "<td>
        <form method='post'>
                <input type='hidden' name='booking-id' value='" . $row['BOOKING_ID'] . "'>
                <input type='submit' class='edit-button-in-list'value='Edit'>
                <input type='submit' class='delete-button-in-list' name='delete' value='Delete'>
            </form>
        </td>";
        echo "</tr>";
    }
}

function BookingDelete($id)
{
    $db = createDB();

    $delete = $db->exec("DELETE FROM BOOKING WHERE BOOKING_ID = '$id'");

    if ($delete) {
        header("Location: dashboard.php");
        exit();
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
        header("Location: dashboard.php");
    } else {
        $error = "Error in inserting room " . $db->lastErrorMsg() . "<br>";
    }
    return $error;
}

function HotelList(){
    $db = createDB();   

    $select_query = "SELECT * FROM HOTEL";
    $result = $db->query($select_query);

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['HOTEL_ID'] . "</td>";
        echo "<td>" . $row['CITY'] . "</td>";
        echo "<td>" . $row['HOTEL_ADDRESS'] . "</td>";
        echo "<td>" . $row['POSTCODE'] . "</td>";
        echo "<td>" . $row['HOTEL_EMAIL'] . "</td>";
        echo "<td>" . $row['HOTEL_TELNO'] . "</td>";
        echo "<td>
        <form method='post'>
                <input type='hidden' name='hotel-id' value='" . $row['HOTEL_ID'] . "'>
                <input type='submit' class='edit-button-in-list'value='Edit'>
                <input type='submit' class='delete-button-in-list' name='delete' value='Delete'>
        </form>
        </td>";
        echo "</tr>";
    }
}

function HotelDelete($id)
{
    $db = createDB();

    $delete = $db->exec("DELETE FROM HOTEL WHERE HOTEL_ID = '$id'");

    if ($delete) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error deleting room type: " . $db->lastErrorMsg();
    }
}

function RoomTypeInsert($type, $description)
{
    $db = createDB();
    $insert = $db->exec("INSERT INTO ROOM_TYPE (ROOM_TYPE_NAME, ROOM_TYPE_DESCRIPTION) VALUES ('$type','$description')");
    if ($insert) {
        header("Location: dashboard.php");
    } else {
        echo "Error in inserting room type " . $db->lastErrorMsg() . "<br>";
    }
}

function RoomTypeList(){
    $db = createDB();   

    $select_query = "SELECT * FROM ROOM_TYPE";
    $result = $db->query($select_query);

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['ROOM_TYPE_ID'] . "</td>";
        echo "<td>" . $row['ROOM_TYPE_NAME'] . "</td>";
        echo "<td>" . $row['ROOM_TYPE_DESCRIPTION'] . "</td>";
        echo "<td>
        <form method='post'>
                <input type='hidden' name='room-type-id' value='" . $row['ROOM_TYPE_ID'] . "'>
                <input type='submit' class='edit-button-in-list' name='edit' value='Edit'>
                <input type='submit' class='delete-button-in-list' name='delete' value='Delete'>
            </form>
        </td>";
        echo "</tr>";
    }
}

function RoomTypeDelete($id)
{
    $db = createDB();

    $delete = $db->exec("DELETE FROM ROOM_TYPE WHERE ROOM_TYPE_ID = '$id'");

    if ($delete) {
        header("Location: dashboard.php");
        exit();
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
        header("Location: dashboard.php");
    } else {
        $error = "Error in inserting room " . $db->lastErrorMsg() . "<br>";
    }
    return $error;
}

function RoomList(){
    $db = createDB();   

    $select_query = "SELECT * FROM ROOM";
    $result = $db->query($select_query);

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['HOTEL_ID'] . "</td>";
        echo "<td>" . $row['ROOM_ID'] . "</td>";
        echo "<td>" . $row['ROOM_TYPE_ID'] . "</td>";
        echo "<td>" . $row['ROOM_NO'] . "</td>";
        echo "<td>" . $row['PRICE'] . "</td>";
        echo "<td>
        <form method='post'>
                <input type='hidden' name='room-id' value='" . $row['ROOM_ID'] . "'>
                <input type='submit' class='edit-button-in-list'value='Edit'>
                <input type='submit' class='delete-button-in-list' name='delete' value='Delete'>
        </form>
        </td>";
        echo "</tr>";
    }
}

function RoomDelete($id)
{
    $db = createDB();

    $delete = $db->exec("DELETE FROM ROOM WHERE ROOM_ID = '$id'");

    if ($delete) {
        header("Location: dashboard.php");
        exit();
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
        header("Location: dashboard.php");
    } else {
        $error = "Error in inserting room " . $db->lastErrorMsg() . "<br>";
    }
    return $error;
}

function GuestList(){
    $db = createDB();   

    $select_query = "SELECT * FROM GUEST";
    $result = $db->query($select_query);

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $name = trim($row['F_NAME'] . " " . $row['M_NAME'] . " " . $row['L_NAME']);
        echo "<tr>";
        echo "<td>" . $row['GUEST_ID'] . "</td>";
        echo "<td>" . $name . "</td>";
        echo "<td>" . $row['GUEST_ADDRESS'] . "</td>";
        echo "<td>" . $row['CITY'] . "</td>";
        echo "<td>" . $row['POSTCODE'] . "</td>";
        echo "<td>" . $row['GUEST_EMAIL'] . "</td>";
        echo "<td>" . $row['GUEST_PHNO'] . "</td>";
        echo "<td>
        <form method='post'>
                <input type='hidden' name='guest-id' value='" . $row['GUEST_ID'] . "'>
                <input type='submit' class='edit-button-in-list'value='Edit'>
                <input type='submit' class='delete-button-in-list' name='delete' value='Delete'>
        </form>
        </td>";
        echo "</tr>";
    }
}

function GuestDelete($id)
{
    $db = createDB();

    $delete = $db->exec("DELETE FROM GUEST WHERE GUEST_ID = '$id'");

    if ($delete) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error deleting room type: " . $db->lastErrorMsg();
    }
}



?>