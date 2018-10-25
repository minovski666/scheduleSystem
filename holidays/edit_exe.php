<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require_once '../includes/db.php';
require_once '../includes/class.php';

$object = new Database();
$table_name = " holidays ";

$column_value = " holiday='" . $_POST['holiday'] . "',
holiday_date='" . $_POST['holiday_date'] . "',celebrated_id='" . $_POST['celebrated'] . "' ";

$pk = " holiday_id ";
$pk_value = $_POST['holiday_id'];


//update records database with pk_value string
$object->editSTR($table_name, $column_value, $pk, $pk_value);

header("Location:index.php");
exit();