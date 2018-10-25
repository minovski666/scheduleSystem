<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}

require_once '../includes/db.php';
require_once '../includes/class.php';

$object = new Database();
$table_name = " locations ";
$column_name = " location, region_id, location_code ";

$column_value = " '" . $_POST['region'] . "', '" . $_POST['city'] . "', '" . $_POST['location_code'] . "' ";

//insert records in database table admins
$object->insert($table_name, $column_name, $column_value);

header("Location:index.php");
exit();