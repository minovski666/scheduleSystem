<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require_once '../includes/db.php'

?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

<?php
if ($_POST['check']) {
    $number_of_value = count($_POST['check']);
    $array_value = $_POST['check'];
} else {
    header('Location:index.php');
}

?>


<div>
    <br>
    <h3 class="text-center font-weight-bold text-white">Schedules</h3><br>
    <?php if ($_SESSION['position_id'] == '3' || $_SESSION['position_id'] == '4' || $_SESSION['position_id'] == '1') { ?>
    <form action="lock_exe.php" method="post">
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

            for ($counter = 0; $counter < $number_of_value; $counter++) {

                $value = $array_value[$counter];

                $sql = "SELECT * FROM schedules INNER JOIN locations ON locations.location_id = schedules.location_id INNER JOIN employees ON employees.employee_id = schedules.employee_id WHERE schedule_id = '$value'";


                $result = $conn->query($sql);
                while ($row = $result->fetch_object()) {
                    $schedule_id = $row->schedule_id;
                    $schedule_location_id = $row->location_id;
                    $schedule_region_id = $row->region_id;
                    $nationality = $row->nationality_id;
                    $religion = $row->religion_id;

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
                    $location = $row->location;
                    $employee_name = $row->name;
                    $employee_lastname = $row->last_name;
                    $newMonday = date("d-m-Y", strtotime($monday_date));
                    $newTuesday = date("d-m-Y", strtotime($tuesday_date));
                    $newWednesday = date("d-m-Y", strtotime($wednesday_date));
                    $newThursday = date("d-m-Y", strtotime($thursday_date));
                    $newFriday = date("d-m-Y", strtotime($friday_date));
                    $newSaturday = date("d-m-Y", strtotime($saturday_date));
                    $newSunday = date("d-m-Y", strtotime($sunday_date));

                    echo "    
    
            <tr>
                <th scope='col' colspan='2'><input type='hidden' name='schedule_id[]' value='$schedule_id'</th>
                
                <td><input type='hidden' name='monday_date[]' value='$monday_date'>$newMonday</td>
                <td><input type='hidden' name='tuesday_date[]' value='$tuesday_date'>$newTuesday</td>
                <td><input type='hidden' name='wednesday_date[]' value='$wednesday_date'>$newWednesday</td>
                <td><input type='hidden' name='thursday_date[]' value='$thursday_date'>$newThursday</td>
                <td><input type='hidden' name='friday_date[]' value='$friday_date'>$newFriday</td>
                <td><input type='hidden' name='saturday_date[]' value='$saturday_date'>$newSaturday</td>
                <td><input type='hidden' name='sunday_date[]' value='$sunday_date'>$newSunday</td>            
            </tr>

        
        <tr>
            <td><input type='hidden' name='city[]' value='$schedule_location_id:$schedule_region_id'>$location</td>
            <td><input type='hidden' name='employees[]' value='$schedule_employee_id:$nationality:$religion'>$employee_name $employee_lastname</td>
            <td><input type='hidden' name='monday[]' value='$monday:$monday_shift'>$monday_shift</td>
            <td><input type='hidden' name='tuesday[]' value='$tuesday:$tuesday_shift'>$tuesday_shift</td>
            <td><input type='hidden' name='wednesday[]' value='$wednesday:$wednesday_shift'>$wednesday_shift</td>
            <td><input type='hidden' name='thursday[]' value='$thursday:$thursday_shift'>$thursday_shift</td>
            <td><input type='hidden' name='friday[]' value='$friday:$friday_shift'>$friday_shift</td>
            <td><input type='hidden' name='saturday[]' value='$saturday:$saturday_shift'>$saturday_shift</td>
            <td><input type='hidden' name='sunday[]' value='$sunday:$sunday_shift'>$sunday_shift</td>
            
        </tr>";

                }
            }

            echo "<tr><td><input class='btn btn-info btn-block' type='submit' name='submit' value='Lock'></td></tr>";


            ?>

            </tbody>
        </table>
    </form>
</div>

<?php } else {
    echo "<h1 class='text-center font-weight-bold'>You are not allowed to see this section.</h1>";
} ?>

<?php include '../includes/footer.php'; ?>



