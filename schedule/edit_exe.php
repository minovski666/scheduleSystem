<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}

require_once '../includes/db.php';
require_once '../includes/class.php';

$object = new Database();
$table_name = " schedules ";

$monday_html = htmlentities($_POST['monday_date']);
$monday_date = date('Y-m-d', strtotime($monday_html));

$tuesday_html = htmlentities($_POST['tuesday_date']);
$tuesday_date = date('Y-m-d', strtotime($tuesday_html));

$wednesday_html = htmlentities($_POST['wednesday_date']);
$wednesday_date = date('Y-m-d', strtotime($wednesday_html));

$thursday_html = htmlentities($_POST['thursday_date']);
$thursday_date = date('Y-m-d', strtotime($thursday_html));

$friday_html = htmlentities($_POST['friday_date']);
$friday_date = date('Y-m-d', strtotime($friday_html));

$saturday_html = htmlentities($_POST['saturday_date']);
$saturday_date = date('Y-m-d', strtotime($saturday_html));

$sunday_html = htmlentities($_POST['sunday_date']);
$sunday_date = date('Y-m-d', strtotime($sunday_html));


$monday = "" . $_POST['monday'] . "";
$monday_value = preg_split('[:]', $monday)[0];
$monday_text = preg_split('[:]', $monday)[1];


$tuesday = "" . $_POST['tuesday'] . "";
$tuesday_value = preg_split('[:]', $tuesday)[0];
$tuesday_text = preg_split('[:]', $tuesday)[1];


$wednesday = "" . $_POST['wednesday'] . "";
$wednesday_value = preg_split('[:]', $wednesday)[0];
$wednesday_text = preg_split('[:]', $wednesday)[1];


$thursday = "" . $_POST['thursday'] . "";
$thursday_value = preg_split('[:]', $thursday)[0];
$thursday_text = preg_split('[:]', $thursday)[1];


$friday = "" . $_POST['friday'] . "";
$friday_value = preg_split('[:]', $friday)[0];
$friday_text = preg_split('[:]', $friday)[1];


$saturday = "" . $_POST['saturday'] . "";
$saturday_value = preg_split('[:]', $saturday)[0];
$saturday_text = preg_split('[:]', $saturday)[1];


$sunday = "" . $_POST['sunday'] . "";
$sunday_value = preg_split('[:]', $sunday)[0];
$sunday_text = preg_split('[:]', $sunday)[1];

$column_value = " location_id='" . $_POST['city'] . "',employee_id='" . $_POST['employees'] . "',monday='$monday_value',monday_shift='$monday_text',monday_date='$monday_date',tuesday='$tuesday_value',tuesday_shift='$tuesday_text',tuesday_date='$tuesday_date',wednesday='$wednesday_value',wednesday_shift='$wednesday_text',wednesday_date='$wednesday_date',thursday='$thursday_value',thursday_shift='$thursday_text',thursday_date='$thursday_date',friday='$friday_value',friday_shift='$friday_text',friday_date='$friday_date',saturday='$saturday_value',saturday_shift='$saturday_text',saturday_date='$saturday_date',sunday='$sunday_value',sunday_shift='$sunday_text',sunday_date='$sunday_date',status='unlocked' ";


$pk = " schedule_id ";
$pk_value = $_POST['schedule_id'];


//update records database with pk_value

$object->editINT($table_name, $column_value, $pk, $pk_value);

header("Location:index.php");

exit();





