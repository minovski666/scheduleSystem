<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}

require_once '../includes/db.php';
require_once '../includes/class.php';

$object = new Database();
$table_name = " regions ";
$column_name = " region ";

$column_value = " '" . $_POST['region'] . "' ";
//
//echo $column_value;
//exit();


//insert records in database table admins
$object->insert($table_name, $column_name, $column_value);

header("Location:index.php");
exit();