<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require '../includes/db.php';
require_once '../includes/class.php';


$object = new Database();
$table_name = " schedules ";
$column_name = " location_id, region_id, employee_id, monday, monday_shift, monday_date, tuesday, tuesday_shift, tuesday_date, wednesday, wednesday_shift, wednesday_date, thursday, thursday_shift, thursday_date, friday, friday_shift, friday_date, saturday, saturday_shift, saturday_date, sunday, sunday_shift, sunday_date, status ";

$count = count($_POST['category-group']);

for ($i = 0; $i < $count; $i++) {


    $monday_html = htmlentities($_POST['category-group'][$i]['monday_date']);
    $monday_date = date('Y-m-d', strtotime($monday_html));

    $tuesday_html = htmlentities($_POST['category-group'][$i]['tuesday_date']);
    $tuesday_date = date('Y-m-d', strtotime($tuesday_html));

    $wednesday_html = htmlentities($_POST['category-group'][$i]['wednesday_date']);
    $wednesday_date = date('Y-m-d', strtotime($wednesday_html));

    $thursday_html = htmlentities($_POST['category-group'][$i]['thursday_date']);
    $thursday_date = date('Y-m-d', strtotime($thursday_html));

    $friday_html = htmlentities($_POST['category-group'][$i]['friday_date']);
    $friday_date = date('Y-m-d', strtotime($friday_html));

    $saturday_html = htmlentities($_POST['category-group'][$i]['saturday_date']);
    $saturday_date = date('Y-m-d', strtotime($saturday_html));

    $sunday_html = htmlentities($_POST['category-group'][$i]['sunday_date']);
    $sunday_date = date('Y-m-d', strtotime($sunday_html));

    $monday = $_POST['category-group'][$i]['monday'];
    $monday_value = preg_split('[:]', $monday)[0];
    $monday_text = preg_split('[:]', $monday)[1];

    $tuesday = $_POST['category-group'][$i]['tuesday'];
    $tuesday_value = preg_split('[:]', $tuesday)[0];
    $tuesday_text = preg_split('[:]', $tuesday)[1];


    $wednesday = $_POST['category-group'][$i]['wednesday'];
    $wednesday_value = preg_split('[:]', $wednesday)[0];
    $wednesday_text = preg_split('[:]', $wednesday)[1];


    $thursday = $_POST['category-group'][$i]['thursday'];
    $thursday_value = preg_split('[:]', $thursday)[0];
    $thursday_text = preg_split('[:]', $thursday)[1];


    $friday = $_POST['category-group'][$i]['friday'];
    $friday_value = preg_split('[:]', $friday)[0];
    $friday_text = preg_split('[:]', $friday)[1];


    $saturday = $_POST['category-group'][$i]['saturday'];
    $saturday_value = preg_split('[:]', $saturday)[0];
    $saturday_text = preg_split('[:]', $saturday)[1];


    $sunday = $_POST['category-group'][$i]['sunday'];
    $sunday_value = preg_split('[:]', $sunday)[0];
    $sunday_text = preg_split('[:]', $sunday)[1];

    $city = $_POST['category-group'][$i]['city'];
    $city_id = preg_split('[:]', $city)[0];
    $region_id = preg_split('[:]', $city)[1];
    $employees = $_POST['category-group'][$i]['employees'];


    $column_value[$i] = " '$city_id', '$region_id', '$employees','$monday_value','$monday_text','$monday_date','$tuesday_value','$tuesday_text','$tuesday_date','$wednesday_value','$wednesday_text','$wednesday_date','$thursday_value','$thursday_text','$thursday_date','$friday_value','$friday_text','$friday_date','$saturday_value','$saturday_text','$saturday_date','$sunday_value','$sunday_text','$sunday_date','unlocked' ";

    $object->insert($table_name, $column_name, $column_value[$i]);


}
header('Location:index.php');
exit();