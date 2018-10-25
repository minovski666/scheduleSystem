<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require_once '../includes/db.php';
require_once '../includes/class.php';

$object = new Database();
$table_name = " locations ";

$column_value = " location='" . $_POST['city'] . "', region_id='" . $_POST['region'] . "', location_code ='" . $_POST['location_code'] . "' ";

$pk = " location_id ";
$pk_value = $_POST['location_id'];


//update records database with pk_value string
$object->editSTR($table_name, $column_value, $pk, $pk_value);

header("Location:index.php");
exit();