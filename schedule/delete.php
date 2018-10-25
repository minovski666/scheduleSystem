<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require_once '../includes/db.php';
require_once '../includes/class.php';

$object = new Database();
$table_name = "schedules";
$pk = "schedule_id";
$pk_value = $_GET['id'];

//delete records from database with pk_value string
$object->deleteSTR($table_name, $pk, $pk_value);
header("Location:index.php");
exit();