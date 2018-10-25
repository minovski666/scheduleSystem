<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require_once '../includes/db.php'

?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

    <script>

        function showFinalRegion(str) {
            if (str == "") {
                document.getElementById("selected").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("selected").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "selectedRegion.php?final_region_id=" + str, true);
                xmlhttp.send();
            }
        }

        function showFinalLocation(str) {
            if (str == "") {
                document.getElementById("selected").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("selected").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "selectedLocation.php?final_location_id=" + str, true);
                xmlhttp.send();
            }
        }

    </script>


    <div>
        <br>
        <h3 class="text-center font-weight-bold text-white">Final schedules</h3><br>
        <?php if ($_SESSION['position_id'] == '3' || $_SESSION['position_id'] == '4' || $_SESSION['position_id'] == '1') { ?>
        <div class="row">
            <div class="col-9">
                <form action="" method="post">
                    <?php if ($_SESSION['position_id'] == '3'){ ?>
                        <span style="color: white;">Filter by region: </span>
                        <select name="selected" id="region" onchange="showFinalRegion(this.value)">
                            <option name="region_id" id="region_id" value="">Select region</option>
                            <option name="region_id" id="region_id" value="0">All</option>

                            <?php

                            $sql3 = "SELECT * FROM regions WHERE region_id>1";

                            $result3 = $conn->query($sql3);
                            while ($row3 = $result3->fetch_object()) {
                                $region_id = $row3->region_id;
                                $region = $row3->region;

                                echo "<option name='region_id' id='region_id' value='$region_id'>$region</option>";
                            }

                            ?>
                        </select>

                        <span style="color: white;">Filter by location: </span>
                        <select name="selected" id="location" onchange="showFinalLocation(this.value)">
                            <option name="location_id" id="location_id" value="">Select location</option>
                            <option name="location_id" id="location_id" value="0">All</option>

                            <?php

                            $sql3 = "SELECT * FROM locations WHERE location_id>1";

                            $result3 = $conn->query($sql3);
                            while ($row3 = $result3->fetch_object()) {
                                $location_id = $row3->location_id;
                                $location = $row3->location;

                                echo "<option name='location_id' id='location_id' value='$location_id'>$location</option>";
                            }

                            ?>
                        </select>

                    <?php } elseif ($_SESSION['position_id'] == '4') { ?>

                        <span style="color: white;">Filter by location: </span>
                        <select name="selected" id="region" onchange="showFinalLocation(this.value)">
                            <option name="location_id" id="location_id" value="">Select location</option>
                            <option name="location_id" id="location_id" value="0">All</option>

                            <?php

                            $sql3 = "SELECT * FROM locations WHERE location_id>1 AND region_id = '{$_SESSION['region_id']}'";

                            $result3 = $conn->query($sql3);
                            while ($row3 = $result3->fetch_object()) {
                                $location_id = $row3->location_id;
                                $location = $row3->location;

                                echo "<option name='location_id' id='location_id' value='$location_id'>$location</option>";
                            }

                            ?>
                        </select>


                    <?php }
                    elseif ($_SESSION['position_id'] == '1') { ?>

                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th scope="col">Location</th>
                            <th scope="col">Name</th>
                            <th scope="col">Monday</th>
                            <th scope="col">Tuesday</th>
                            <th scope="col">Wednesday</th>
                            <th scope="col">Thursday</th>
                            <th scope="col">Friday</th>
                            <th scope="col">Saturday</th>
                            <th scope="col">Sunday</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        $region_session = $_SESSION['region_id'];
                        $location_session = $_SESSION['location_id'];

                        $sql = "SELECT * FROM schedules 
                        INNER JOIN locations ON schedules.location_id = locations.location_id
                        INNER JOIN employees ON schedules.employee_id = employees.employee_id AND locations.location_id = '$location_session' AND schedules.status= 'locked' LIMIT 8";

                        $result = $conn->query($sql);
                        while ($row = $result->fetch_object()) {
                            $schedule_id = $row->schedule_id;
                            $location_id = $row->location_id;
                            $location = $row->location;
                            $employee_id = $row->employee_id;
                            $employee_name = $row->name;
                            $employee_lastname = $row->last_name;
                            $monday = $row->monday;
                            $monday_shift = $row->monday_shift;
                            $monday_date = $row->monday_date;
                            $tuesday = $row->tuesday;
                            $tuesday_shift = $row->tuesday_shift;
                            $tuesday_date = $row->tuesday_date;
                            $wednesday = $row->wednesday;
                            $wednesday_shift = $row->wednesday_shift;
                            $wednesday_date = $row->wednesday_date;
                            $thursday = $row->thursday;
                            $thursday_shift = $row->thursday_shift;
                            $thursday_date = $row->thursday_date;
                            $friday = $row->friday;
                            $friday_shift = $row->friday_shift;
                            $friday_date = $row->friday_date;
                            $saturday = $row->saturday;
                            $saturday_shift = $row->saturday_shift;
                            $saturday_date = $row->saturday_date;
                            $sunday = $row->sunday;
                            $sunday_shift = $row->sunday_shift;
                            $sunday_date = $row->sunday_date;
                            $newMonday = date("d-m-Y", strtotime($monday_date));
                            $newTuesday = date("d-m-Y", strtotime($tuesday_date));
                            $newWednesday = date("d-m-Y", strtotime($wednesday_date));
                            $newThursday = date("d-m-Y", strtotime($thursday_date));
                            $newFriday = date("d-m-Y", strtotime($friday_date));
                            $newSaturday = date("d-m-Y", strtotime($saturday_date));
                            $newSunday = date("d-m-Y", strtotime($sunday_date));


                            echo "    
    
            <tr>
                <td colspan='2'></td>
                <td>$newMonday</td>
                <td>$newTuesday</td>
                <td>$newWednesday</td>
                <td>$newThursday</td>
                <td>$newFriday</td>
                <td>$newSaturday</td>
                <td>$newSunday</td>            
            </tr>

        
        <tr>
            <td>$location</td>
            <td>$employee_name $employee_lastname</td>
            <td>$monday_shift</td>
            <td>$tuesday_shift</td>
            <td>$wednesday_shift</td>
            <td>$thursday_shift</td>
            <td>$friday_shift</td>
            <td>$saturday_shift</td>
            <td>$sunday_shift</td>    
        </tr>";

                        }
                        }
                        ?>

                        </tbody>
                    </table>
                    <div id="selected"></div>

                </form>
            </div>

            <div class="col-3 side">
                <br><h5 class="text-center font-weight-bold text-white">Calculate working hours</h5><br>
                <form action="" method="POST">
                    <table class="table table-sm">

                        <tr>
                            <th scope="col" class="text-white">Select employee</th>
                        </tr>
                        <tr>

                            <td><select name="employee" id="employee">
                                    <option value="">--Select--</option>

                                    <?php
                                    if ($_SESSION['position_id'] == '3') {

                                        $sql_employees = "SELECT * FROM schedule2 INNER JOIN employees ON schedule2.employee_id = employees.employee_id AND schedule_id IN (SELECT MAX(schedule_id) FROM schedule2 GROUP BY employee_id) ";

                                    } elseif ($_SESSION['position_id'] == '4') {

                                        $sql_employees = "SELECT * FROM schedule2 INNER JOIN employees ON schedule2.employee_id = employees.employee_id AND schedule_id IN (SELECT MAX(schedule_id) FROM schedule2 GROUP BY employee_id) AND employees.region_id = '{$_SESSION['region_id']}' ";

                                    } else {

                                        $sql_employees = "SELECT * FROM schedule2 INNER JOIN employees ON schedule2.employee_id = employees.employee_id AND schedule_id IN (SELECT MAX(schedule_id) FROM schedule2 GROUP BY employee_id) AND employees.location_id = '$location_session' ";

                                    }
                                    $name = '';
                                    $last_name = '';
                                    $result_employees = $conn->query($sql_employees);
                                    while ($row_employees = $result_employees->fetch_object()) {
                                        $employee_id = $row_employees->employee_id;
                                        $name = $row_employees->name;
                                        $last_name = $row_employees->last_name;

                                        echo "<option name='employee_id' value='$employee_id'>$name $last_name</option>";
                                    }
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <th scope="col" class="text-white">From:</th>
                        </tr>
                        <tr>
                            <td><input type="text" id="from_date" value="" name="from_date"></td>
                        </tr>
                        <tr>
                            <th scope="col" class="text-white">To:</th>
                        </tr>
                        <tr>
                            <td><input type="text" id="to_date" value="" name="to_date"></td>
                        </tr>
                        <tr>
                            <td>
                                <button class='btn btn-info text-white'>Calculate</button>
                            </td>
                        </tr>

                        <?php

                        if (!empty($_POST['from_date']) && !empty($_POST['to_date']) && !empty($_POST['employee'])) {

                            $from_html = htmlentities($_POST['from_date']);
                            $from_date = date('Y-m-d', strtotime($from_html));
                            $to_html = htmlentities($_POST['to_date']);
                            $to_date = date('Y-m-d', strtotime($to_html));

                            $employee = $_POST['employee'];

                            $sql_sum = "SELECT SUM(shift_lenght) as sum FROM schedule2 WHERE schedule2.day_date BETWEEN '$from_date' AND '$to_date' AND schedule2.employee_id = '$employee' ";

                            $sql_night = "SELECT SUM(shift_night) as sum_night FROM schedule2 WHERE schedule2.day_date BETWEEN '$from_date' AND '$to_date' AND schedule2.employee_id = '$employee' ";

                            $sql_holiday = "SELECT SUM(holiday_day) as sum_holiday FROM schedule2 WHERE schedule2.day_date BETWEEN '$from_date' AND '$to_date' AND schedule2.employee_id = '$employee' ";

                            $sql_holiday_night = "SELECT SUM(holiday_night) as sum_holiday_night FROM schedule2 WHERE schedule2.day_date BETWEEN '$from_date' AND '$to_date' AND schedule2.employee_id = '$employee' ";


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

                                            echo "<tr><td class='text-white'>Working hours from $from_date to $to_date are $sum day hours and $sum_night night hours and day holiday hours are $sum_holiday and night holiday hours are $sum_holiday_night.</td></tr>";
                                        }
                                    }
                                }
                            }
                        } else {

                            echo "<p class='text-white'>Please select employee and date !</p>";

                        }

                        ?>
                    </table>
                </form>


            </div>
        </div>
    </div>

<?php } else {
    echo "<h1 class='text-center font-weight-bold'>You are not allowed to see this section.</h1>";
} ?>

    <script>$('#from_date').datepicker({dateFormat: 'dd-mm-yy', firstDay: '1', dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ], monthNames: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec" ]}).val();</script>
    <script>$('#to_date').datepicker({dateFormat: 'dd-mm-yy', firstDay: '1', dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ], monthNames: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec" ]}).val();</script>

<?php include '../includes/footer.php'; ?>