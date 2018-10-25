<?php require_once '../includes/db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}

?>
<?php
//$value = $_GET['region_id'];
//$finalValue = $_GET['final_region_id'];
?>


<div>
    <?php if (isset($_GET['region_id'])) { ?>
    <form action="" method="post">
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
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php


            if (empty($_GET['region_id'])) {

                $sql = "SELECT * FROM schedules 
                        INNER JOIN locations ON schedules.location_id = locations.location_id
                        INNER JOIN employees ON schedules.employee_id = employees.employee_id AND schedules.status= 'unlocked' ORDER BY schedules.schedule_id DESC";

            } elseif (isset($_GET['region_id'])) {


                $sql = "SELECT * FROM schedules 
                        INNER JOIN locations ON schedules.location_id = locations.location_id
                        INNER JOIN employees ON schedules.employee_id = employees.employee_id AND locations.region_id = " . $_GET['region_id'] . " AND schedules.status= 'unlocked' ORDER BY schedules.schedule_id DESC";

            }
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
                <th scope='col' colspan='2'></th>
                
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
            <td><a class='btn btn-info' href='edit.php?id=$schedule_id'>Edit</a></td>
            <td><a class='btn btn-danger' onclick='return delete_ad($schedule_id)'>Delete</a></td>          
        </tr>";

            }

            ?>

            </tbody>
        </table>
    </form>
</div>
<div>
    <?php } elseif (isset($_GET['final_region_id'])) { ?>

        <form action="" method="post">
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


                if (empty($_GET['final_region_id'])) {

                    $sql = "SELECT * FROM schedules 
                        INNER JOIN locations ON schedules.location_id = locations.location_id
                        INNER JOIN employees ON schedules.employee_id = employees.employee_id AND schedules.status= 'locked' ORDER BY schedules.schedule_id DESC";

                } elseif (isset($_GET['final_region_id'])) {


                    $sql = "SELECT * FROM schedules 
                        INNER JOIN locations ON schedules.location_id = locations.location_id
                        INNER JOIN employees ON schedules.employee_id = employees.employee_id AND locations.region_id = " . $_GET['final_region_id'] . " AND schedules.status= 'locked' ORDER BY schedules.schedule_id DESC";

                }
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
                <th scope='col' colspan='2'></th>
                
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
                ?>
                </tbody>
            </table>
        </form>
    <?php } ?>
</div>