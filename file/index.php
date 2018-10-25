<?php
require_once '../includes/db.php';
require_once '../includes/class.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}


?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>


<div>

    <form action='' method='POST'>


        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th>From :</th>
                <th><input type="text" id="from_date" value="" name="from_date"></th>
                <th>To :</th>
                <th><input type="text" id="to_date" value="" name="to_date"></th>

            </tr>
            <tr>
                <th colspan="2" class="text-center">Employee</th>
                <th colspan="2" class="text-center">Working hours</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($_SESSION['position_id'] == '3') {
                $sql_employees = "SELECT * FROM schedule2 INNER JOIN employees ON schedule2.employee_id = employees.employee_id INNER JOIN locations ON schedule2.location_id = locations.location_id AND schedule_id IN (SELECT MAX(schedule_id) FROM schedule2 GROUP BY employee_id) ";
            } elseif ($_SESSION['position_id'] == '4') {
                $sql_employees = "SELECT * FROM schedule2 INNER JOIN employees ON schedule2.employee_id = employees.employee_id INNER JOIN locations ON schedule2.location_id = locations.location_id AND schedule_id IN (SELECT MAX(schedule_id) FROM schedule2 GROUP BY employee_id) AND schedule2.region_id = '{$_SESSION['region_id']}'";
            } elseif ($_SESSION['position_id'] == '1') {
                $sql_employees = "SELECT * FROM schedule2 INNER JOIN employees ON schedule2.employee_id = employees.employee_id INNER JOIN locations ON schedule2.location_id = locations.location_id AND schedule_id IN (SELECT MAX(schedule_id) FROM schedule2 GROUP BY employee_id) AND schedule2.location_id = '{$_SESSION['location_id']}'";
            }
            $result_employees = $conn->query($sql_employees);

            while ($row_employees = $result_employees->fetch_object()) {

                $employee_id = $row_employees->employee_id;
                $name = $row_employees->name;
                $last_name = $row_employees->last_name;
                $location_id = $row_employees->location_id;
                $region_id = $row_employees->region_id;
                $employee_code = $row_employees->employee_code;
                $location_code = $row_employees->location_code;


                echo "<tr><td colspan='2'><input type='hidden' name='employee_id[]' id='employee_id' value='$employee_id:$employee_code:$region_id:$location_id:$location_code'>$name $last_name</td>";


                if (!empty($_POST['from_date']) && !empty($_POST['to_date'])) {

                    $from_html = htmlentities($_POST['from_date']);
                    $from_date = date('Y-m-d', strtotime($from_html));
                    $to_html = htmlentities($_POST['to_date']);
                    $to_date = date('Y-m-d', strtotime($to_html));

                    $month_ht = htmlentities($_POST['from_date']);
                    $month = date('m-Y', strtotime($month_ht));

                    $sql_sum = "SELECT SUM(shift_lenght) as sum FROM schedule2 WHERE schedule2.day_date BETWEEN '$from_date' AND '$to_date' AND schedule2.employee_id = '$employee_id' ";

                    $sql_night = "SELECT SUM(shift_night) as sum_night FROM schedule2 WHERE schedule2.day_date BETWEEN '$from_date' AND '$to_date' AND schedule2.employee_id = '$employee_id' ";

                    $sql_holiday = "SELECT SUM(holiday_day) as sum_holiday FROM schedule2 WHERE schedule2.day_date BETWEEN '$from_date' AND '$to_date' AND schedule2.employee_id = '$employee_id' ";

                    $sql_holiday_night = "SELECT SUM(holiday_night) as sum_holiday_night FROM schedule2 WHERE schedule2.day_date BETWEEN '$from_date' AND '$to_date' AND schedule2.employee_id = '$employee_id' ";


                    $result_night = $conn->query($sql_night);
                    $result_sum = $conn->query($sql_sum);
                    $result_holiday = $conn->query($sql_holiday);
                    $result_holiday_night = $conn->query($sql_holiday_night);
                    while ($row_sum = $result_sum->fetch_object()) {
                        $sum = $row_sum->sum;

                        while ($row_night = $result_night->fetch_object()) {
                            $sum_night = $row_night->sum_night;

                            while ($row_holiday = $result_holiday->fetch_object()) {
                                $sum_holiday = $row_holiday->sum_holiday;

                                while ($row_holiday_night = $result_holiday_night->fetch_object()) {
                                    $sum_holiday_night = $row_holiday_night->sum_holiday_night;

                                    echo "<td colspan='2'><input type='hidden' name='sum[]' id='sum' value='$sum:$month:$sum_night:$sum_holiday:$sum_holiday_night'>Работни сати за  $month месец се $sum дневни и $sum_night ноќни сати и празнични дневни сати се $sum_holiday и празнични ноќни сати се $sum_holiday_night.</td></tr>";
                                }
                            }
                        }
                    }

                } else {
                    echo "<td colspan='2'>Please select date.</td>";
                }
            }
            ?>


            <tr>
                <td colspan="4">

                    <input type="submit" name="calulate" class="btn btn-danger" id="calculate" value="Calculate">
                </td>
            </tr>
            <?php
            if (isset($_POST['employee_id']) && !empty($_POST['from_date']) && !empty($_POST['to_date'])) {
                echo "<tr>
                <td colspan = '4'>
                    <input type = 'submit' name = 'createCSV' class='btn btn-danger' id = 'createCSV' value = 'Create CSV'>
                </td >
            </tr>";
            } else {
                echo "<tr>
<td>Please calculate working hours in order to create file.</td>

</tr>";
            }
            ?>
            </tbody>

        </table>
    </form>


</div>

<?php
if (isset($_POST['createCSV'])) {
    $object = new Database();
    $table_name = " files ";
    $column_name = " location_id, region_id, employee_code, location_code, month_year, hours, night_hours, holiday, holiday_night ";

    $count = count($_POST['employee_id']);

    for ($i = 0; $i < $count; $i++) {


        $employee_id = $_POST['employee_id'][$i];
        $location_id = preg_split('[:]', $employee_id)[3];
        $region_id = preg_split('[:]', $employee_id)[2];
        $employee_code = preg_split('[:]', $employee_id)[1];
        $location_code = preg_split('[:]', $employee_id)[4];


        $sum_id = $_POST['sum'][$i];
        $sum_f = preg_split('[:]', $sum_id)[0];
        $month_date = preg_split('[:]', $sum_id)[1];
        $sum_n = preg_split('[:]', $sum_id)[2];
        $holiday = preg_split('[:]', $sum_id)[3];
        $holiday_n = preg_split('[:]', $sum_id)[4];


        $column_value = " '$location_id', '$region_id', '$employee_code', '$location_code', '$month_date', '$sum_f', '$sum_n', '$holiday', '$holiday_n' ";
        $object->insert($table_name, $column_name, $column_value);

        header('Location: toCSV.php?from_date=' . $month_date . '');

    }

//    $result = $conn->query("SELECT * FROM files WHERE files.month = '$month_date'");
//    if (!$result) die('Couldn\'t fetch records');
//    $num_fields = mysqli_num_fields($result);
//    $filename = "schedule_" . date("d-m-Y-h:i") . ".csv";
//    $headers = array();
//    while ($fieldinfo = mysqli_fetch_field($result)) {
//        $headers[] = $fieldinfo->name;
//    }
//    $fp = fopen('php://output', 'r');
//    if ($fp && $result) {
//        header('Content-Type: text/csv');
//        header('Content-Disposition: attachment; filename='.$filename.'');
//        header('Pragma: no-cache');
//        header('Expires: 0');
//        fputcsv($fp, $headers);
//        while ($row = $result->fetch_array(MYSQLI_NUM)) {
//            fputcsv($fp, array_values($row));
//        }
//        die;
//    }
}
?>
<script>$('#from_date').datepicker({dateFormat: 'dd-mm-yy', firstDay: '1', dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ], monthNames: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec" ]}).val();</script>
<script>$('#to_date').datepicker({dateFormat: 'dd-mm-yy', firstDay: '1', dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ], monthNames: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec" ]}).val();</script>

<?php include '../includes/footer.php'; ?>
