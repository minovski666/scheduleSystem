<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require_once '../includes/db.php'

?>
<?php $sql = "SELECT * FROM schedules WHERE schedule_id = '" . $_GET['id'] . "'";

$result = $conn->query($sql);
while ($row = $result->fetch_object()) {
    $schedule_id = $row->schedule_id;
    $schedule_location_id = $row->location_id;

    $schedule_employee_id = $row->employee_id;
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

}
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

    <div>
    <br><h3 class="text-center font-weight-bold text-white">Schedules</h3><br>
<?php if ($_SESSION['position_id'] == '3' || $_SESSION['position_id'] == '4' || $_SESSION['position_id'] == '1') { ?>
    <form name="form" action="edit_exe.php" method="post">
        <table class="table table-striped table-dark">
            <tr>
            <tr>
                <th scope="col">Name</th>
                <td><select name="employees" id="employees" required>
                        <?php


                        $sql_employees = "SELECT * FROM employees";
                        $result_employees = $conn->query($sql_employees);

                        while ($row_employees = $result_employees->fetch_object()) {
                            $employee_idd = $row_employees->employee_id;
                            $name = $row_employees->name;
                            $last_name = $row_employees->last_name;


                            if ($employee_idd == $schedule_employee_id) {

                                echo "<option selected value='{$employee_idd}'>$name $last_name</option>";
                            } else {
                                echo "<option value='{$employee_idd}'>$name $last_name</option>";
                            }

                        }


                        ?>
                    </select></td>
                <input type='hidden' name='schedule_id' value='<?= $schedule_id ?>'>
            </tr>
            <tr>
                <th scope="col">Location</th>
                <td><select name="city" id="city" required>
                        <?php

                        $sql_region = "SELECT * FROM locations WHERE location_id>1";
                        $result_region = $conn->query($sql_region);
                        while ($row_region = $result_region->fetch_object()) {
                            $location_id = $row_region->location_id;
                            $location = $row_region->location;


                            if ($location_id == $schedule_location_id) {

                                echo "<option selected value='{$location_id}'>$location</option>";
                            } else {
                                echo "<option value='{$location_id}'>$location</option>";
                            }


                        }


                        ?>
                    </select></td>
            </tr>
            <tr>
                <td></td>
                <td>Date</td>
                <td>Shift</td>
            </tr>
            <th scope="col">Monday</th>
            <td><input type="text" id="monday_date" name="monday_date" value="<?= $newMonday ?>"
                       required style="width: 147px"></td>

            <td><select name="monday" id="monday" required>
                    <?php

                    $sql_monday = "SELECT * FROM shifts";
                    $result_monday = $conn->query($sql_monday);
                    while ($row_monday = $result_monday->fetch_object()) {
                        $shift_id_monday = $row_monday->shift_id;
                        $shift_monday = $row_monday->shift;
                        $hours_monday = $row_monday->hours;


                        if ($shift_monday == $monday_shift) {

                            echo "<option selected value='$hours_monday:$shift_monday'>$shift_monday</option>";
                        } else {
                            echo "<option value='$hours_monday:$shift_monday'>$shift_monday</option>";
                        }

                    }
                    ?>
                </select></td>
            </tr>
            <tr>
                <th scope="col">Tuesday</th>
                <td><input type="text" id="tuesday_date" name="tuesday_date" value="<?= $newTuesday ?>"
                           required style="width: 147px"></td>
                <td><select name="tuesday" id="tuesday" required>
                        <?php

                        $sql_tuesday = "SELECT * FROM shifts";
                        $result_tuesday = $conn->query($sql_tuesday);
                        while ($row_tuesday = $result_tuesday->fetch_object()) {
                            $shift_id_tuesday = $row_tuesday->shift_id;
                            $shift_tuesday = $row_tuesday->shift;
                            $hours_tuesday = $row_tuesday->hours;

                            if ($shift_tuesday == $tuesday_shift) {

                                echo "<option selected value='$hours_tuesday:$shift_tuesday'>$shift_tuesday</option>";
                            } else {
                                echo "<option value='$hours_tuesday:$shift_tuesday'>$shift_tuesday</option>";
                            }
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <th scope="col">Wednesday</th>
                <td><input type="text" id="wednesday_date" name="wednesday_date" value="<?= $newWednesday ?>"
                           required style="width: 147px"></td>
                <td><select name="wednesday" id="wednesday" required>
                        <?php

                        $sql_wednesday = "SELECT * FROM shifts";
                        $result_wednesday = $conn->query($sql_wednesday);
                        while ($row_wednesday = $result_wednesday->fetch_object()) {
                            $shift_id_wednesday = $row_wednesday->shift_id;
                            $shift_wednesday = $row_wednesday->shift;
                            $hours_wednesday = $row_wednesday->hours;

                            if ($shift_wednesday == $wednesday_shift) {

                                echo "<option selected value='$hours_wednesday:$shift_wednesday'>$shift_wednesday</option>";
                            } else {
                                echo "<option value='$hours_wednesday:$shift_wednesday'>$shift_wednesday</option>";
                            }
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <th scope="col">Thursday</th>
                <td><input type="text" id="thursday_date" name="thursday_date" value="<?= $newThursday ?>"
                           required style="width: 147px"></td>
                <td><select name="thursday" id="thursday" required>
                        <?php

                        $sql_thursday = "SELECT * FROM shifts";
                        $result_thursday = $conn->query($sql_thursday);
                        while ($row_thursday = $result_thursday->fetch_object()) {
                            $shift_id_thursday = $row_thursday->shift_id;
                            $shift_thursday = $row_thursday->shift;
                            $hours_thursday = $row_thursday->hours;

                            if ($shift_thursday == $thursday_shift) {

                                echo "<option selected value='$hours_thursday:$shift_thursday'>$shift_thursday</option>";
                            } else {
                                echo "<option value='$hours_thursday:$shift_thursday'>$shift_thursday</option>";
                            }
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <th scope="col">Friday</th>
                <td><input type="text" id="friday_date" name="friday_date" value="<?= $newFriday ?>"
                           required style="width: 147px"></td>
                <td><select name="friday" id="friday" required>
                        <?php

                        $sql_friday = "SELECT * FROM shifts";
                        $result_friday = $conn->query($sql_friday);
                        while ($row_friday = $result_friday->fetch_object()) {
                            $shift_id_friday = $row_friday->shift_id;
                            $shift_friday = $row_friday->shift;
                            $hours_friday = $row_friday->hours;

                            if ($shift_friday == $friday_shift) {

                                echo "<option selected value='$hours_friday:$shift_friday'>$shift_friday</option>";
                            } else {
                                echo "<option value='$hours_friday:$shift_friday'>$shift_friday</option>";
                            }
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <th scope="col">Saturday</th>
                <td><input type="text" id="saturday_date" name="saturday_date" value="<?= $newSaturday ?>"
                           required style="width: 147px"></td>
                <td><select name="saturday" id="saturday" required>
                        <?php

                        $sql_saturday = "SELECT * FROM shifts";
                        $result_saturday = $conn->query($sql_saturday);
                        while ($row_saturday = $result_saturday->fetch_object()) {
                            $shift_id_saturday = $row_saturday->shift_id;
                            $shift_saturday = $row_saturday->shift;
                            $hours_saturday = $row_saturday->hours;

                            if ($shift_saturday == $saturday_shift) {

                                echo "<option selected value='$hours_saturday:$shift_saturday'>$shift_saturday</option>";
                            } else {
                                echo "<option value='$hours_saturday:$shift_saturday'>$shift_saturday</option>";
                            }
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <th scope="col">Sunday</th>
                <td><input type="text" id="sunday_date" name="sunday_date" value="<?= $newSunday ?>"
                           required style="width: 147px"></td>
                <td><select name="sunday" id="sunday" required>
                        <?php

                        $sql_sunday = "SELECT * FROM shifts";
                        $result_sunday = $conn->query($sql_sunday);
                        while ($row_sunday = $result_sunday->fetch_object()) {
                            $shift_id_sunday = $row_sunday->shift_id;
                            $shift_sunday = $row_sunday->shift;
                            $hours_sunday = $row_sunday->hours;

                            if ($shift_sunday == $sunday_shift) {

                                echo "<option selected value='$hours_sunday:$shift_sunday'>$shift_sunday</option>";
                            } else {
                                echo "<option value='$hours_sunday:$shift_sunday'>$shift_sunday</option>";
                            }
                        }
                        ?>
                    </select></td>
            </tr>


            <tr>

                <td colspan="3"><input class="btn btn-danger btn-block" type="submit" name="submit" value="Edit">
                </td>

            </tr>


        </table>
        <script>

            $(document).on('focus', "#monday_date", function () { //bind to all instances of id "monday_date".
                $(this).datepicker({
                    dateFormat: 'dd-mm-yy',
                    firstDay: '1',
                    dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                    monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec"]
                });
            });

            $(document).on('focus', "#tuesday_date", function () { //bind to all instances of id "tuesday_date".
                $(this).datepicker({
                    dateFormat: 'dd-mm-yy',
                    firstDay: '1',
                    dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                    monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec"]
                });
            });

            $(document).on('focus', "#wednesday_date", function () { //bind to all instances of id "wednesday_date".
                $(this).datepicker({
                    dateFormat: 'dd-mm-yy',
                    firstDay: '1',
                    dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                    monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec"]
                });
            });

            $(document).on('focus', "#thursday_date", function () { //bind to all instances of id "thursday_date".
                $(this).datepicker({
                    dateFormat: 'dd-mm-yy',
                    firstDay: '1',
                    dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                    monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec"]
                });
            });

            $(document).on('focus', "#friday_date", function () { //bind to all instances of id "friday_date".
                $(this).datepicker({
                    dateFormat: 'dd-mm-yy',
                    firstDay: '1',
                    dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                    monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec"]
                });
            });

            $(document).on('focus', "#saturday_date", function () { //bind to all instances of id "saturday_date".
                $(this).datepicker({
                    dateFormat: 'dd-mm-yy',
                    firstDay: '1',
                    dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                    monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec"]
                });
            });

            $(document).on('focus', "#sunday_date", function () { //bind to all instances of id "sunday_date".
                $(this).datepicker({
                    dateFormat: 'dd-mm-yy',
                    firstDay: '1',
                    dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                    monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec"]
                });
            });

        </script>
    </form>
    </div>

<?php } else {
    echo "<h1 class='text-center font-weight-bold'>You are not allowed to see this section.</h1>";
} ?>

<?php include '../includes/footer.php'; ?>