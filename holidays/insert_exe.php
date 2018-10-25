<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require '../includes/db.php';
require_once '../includes/class.php';


$object = new Database();
$table_name = " holidays ";
$column_name = " holiday, holiday_date, celebrated_id ";

$count = count($_POST['category-group']);

for ($i = 0; $i < $count; $i++) {


    $holiday_html = htmlentities($_POST['category-group'][$i]['holiday_date']);
    $holiday_date = date('Y-m-d', strtotime($holiday_html));

    $holiday = $_POST['category-group'][$i]['holiday'];

    $celebrated = $_POST['category-group'][$i]['celebrated'];

    $column_value[$i] = " '$holiday', '$holiday_date', '$celebrated' ";

    $object->insert($table_name, $column_name, $column_value[$i]);


}
header('Location:index.php');
exit();