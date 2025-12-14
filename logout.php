<!-- Artificial Intelligence (AI) has not been used for any part of the activity.  -->
<?php
//reference: https://www.w3schools.com/php/php_sessions.asp
//logs the user out by clearing and destroying the session
// redirects to login page

// start session to access session variables
session_start(); 

// remove all session variables
session_unset();

// destroy the session completely 
session_destroy();

// redirect to login page
header("Location: login.php");
exit;
?>