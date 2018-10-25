<?php
require_once '../includes/db.php';
require_once '../includes/class.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}


$month_date = $_GET['from_date'];
$region = $_SESSION['region_id'];
$location = $_SESSION['location_id'];

if ($_SESSION['position_id'] == '3') {
    $result = $conn->query("SELECT DISTINCT employee_code, location_code, month_year, hours, night_hours, holiday, holiday_night FROM files WHERE files.month_year = '$month_date' AND file_id IN (SELECT MAX(file_id) FROM files GROUP BY employee_code)");
} elseif ($_SESSION['position_id'] == '4') {
    $result = $conn->query("SELECT DISTINCT employee_code, location_code, month_year, hours, night_hours, holiday, holiday_night FROM files WHERE files.month_year = '$month_date' AND region_id = '$region' AND file_id IN (SELECT MAX(file_id) FROM files GROUP BY employee_code)");
} elseif ($_SESSION['position_id'] == '1') {
    $result = $conn->query("SELECT DISTINCT employee_code, location_code, month_year, hours, night_hours, holiday, holiday_night FROM files WHERE files.month_year = '$month_date' AND location_id = '$location' AND file_id IN (SELECT MAX(file_id) FROM files GROUP BY employee_code)");
}


if (!$result) die('Couldn\'t fetch records');
$num_fields = mysqli_num_fields($result);
$filename = "monthly calculation_" . date("d-m-Y-h:i") . ".csv";
$headers = array('Employee code', 'Location code', 'Month', 'Day hours', 'Night Hours', 'Holiday hours', 'Night holiday hours');
//while ($fieldinfo = mysqli_fetch_field($result)) {
//    $headers[] = $fieldinfo->name;
//}
$fp = fopen('php://output', 'r');
if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=' . $filename . '');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}
header('Location: index.php');
