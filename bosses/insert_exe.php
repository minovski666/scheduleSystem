<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}

require_once '../includes/db.php';
require_once '../includes/class.php';


$object = new Database();
$table_name = " managers ";
$column_name = " name, last_name, username, password, location_id, region_id, position_id ";

$city = "" . $_POST['city'] . "";
$city_id = preg_split('[:]', $city)[0];
$region_id = preg_split('[:]', $city)[1];

$column_value = " '" . $_POST['first_name'] . "','" . $_POST['last_name'] . "','" . $_POST['username'] . "','" . $_POST['password'] . "', '$city_id', '$region_id', '1' ";

$username = $_POST['username'];
$sql = "SELECT * FROM managers WHERE username = '$username'";

$result = $conn->query($sql);
$count = mysqli_num_rows($result);
if ($count > 0) {
    echo "Username already taken";
} else {
//insert records in database table admins
    $object->insert($table_name, $column_name, $column_value);

    header("Location:index.php");
    exit();
}