<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require_once '../includes/db.php';
require_once '../includes/class.php';

$object = new Database();
$table_name = " managers ";

$city = "" . $_POST['region'] . "";
$city_id = preg_split('[:]', $city)[0];
$region_id = preg_split('[:]', $city)[1];

$column_value = " last_name='" . $_POST['last_name'] . "',
username='" . $_POST['username'] . "',password='" . $_POST['password'] . "',location_id='$city_id',region_id='$region_id',position_id='1' ";

$pk = " manager_id ";
$pk_value = $_POST['manager_id'];


//update records database with pk_value string
$object->editSTR($table_name, $column_value, $pk, $pk_value);
header("Location:index.php");
exit();