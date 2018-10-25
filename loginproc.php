<?php
require_once 'includes/db.php';

//Start the Session
session_start();
// require('includes/db.php');
//3. If the form is submitted or not.
//3.1 If the form is submitted

if (isset($_POST['username']) and isset($_POST['password'])) {
//3.1.1 Assigning posted values to variables.
    $username = $_POST['username'];
    $password = $_POST['password'];
//3.1.2 Checking the values are existing in the database or not
    $query = "SELECT * FROM `managers` WHERE username='$username' and password='$password'";


    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
    if ($count == 1) {
        $_SESSION['username'] = $username;

        $row = mysqli_fetch_assoc($result);
        $_SESSION['position_id'] = $row['position_id'];
        $_SESSION['region_id'] = $row['region_id'];
        $_SESSION['location_id'] = $row['location_id'];

        header('Location: includes/welcome.php');
    } else {
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.

        $fmsg = "Invalid Login Credentials.";
        echo $fmsg;
        header('Location:index.php');
    }
} else {
    header('Location:index.php');
}

