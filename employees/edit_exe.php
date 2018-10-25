<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require_once '../includes/db.php';
require_once '../includes/class.php';

$object = new Database();
$table_name = " employees ";

$city = "" . $_POST['city'] . "";
$city_value = preg_split('[:]', $city)[0];
$city_text = preg_split('[:]', $city)[1];

$column_value = " last_name='" . $_POST['last_name'] . "',region_id='$city_value', location_id='$city_text' ";

$pk = " employee_id ";
$pk_value = $_POST['employee_id'];

//update records database with pk_value string
$object->editSTR($table_name, $column_value, $pk, $pk_value);
header("Location:index.php");
exit();