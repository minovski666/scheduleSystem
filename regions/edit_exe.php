<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require_once '../includes/db.php';
require_once '../includes/class.php';

$object = new Database();
$table_name = " regions ";

$column_value = " region='" . $_POST['region'] . "' ";

$pk = " region_id ";
$pk_value = $_POST['region_id'];


//update records database with pk_value string
$object->editSTR($table_name, $column_value, $pk, $pk_value);

header("Location:index.php");
exit();