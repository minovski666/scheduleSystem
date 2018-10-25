<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require_once '../includes/db.php';
require_once '../includes/class.php';

$object = new Database();
$table_name = " employees ";
$column_name = " employee_code, name, last_name, region_id, location_id, nationality_id, religion_id ";

$city = "" . $_POST['city'] . "";
$city_value = preg_split('[:]', $city)[0];
$city_text = preg_split('[:]', $city)[1];


$column_value = " '" . $_POST['employee_code'] . "', '" . $_POST['first_name'] . "','" . $_POST['last_name'] . "', '$city_value', '$city_text','" . $_POST['nationality'] . "','" . $_POST['religion'] . "' ";


//insert records in database table admins
$object->insert($table_name, $column_name, $column_value);

header("Location:index.php");
exit();