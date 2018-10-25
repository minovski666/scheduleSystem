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

    function showRegion(str) {
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
            xmlhttp.open("GET", "selectedRegion.php?region_id=" + str, true);
            xmlhttp.send();
        }
    }

    function showLocation(str) {
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
            xmlhttp.open("GET", "selectedLocation.php?location_id=" + str, true);
            xmlhttp.send();
        }
    }

</script>


<div>
    <br>
    <h3 class="text-center font-weight-bold text-white">Schedules</h3><br>
    <?php if ($_SESSION['position_id'] == '3' || $_SESSION['position_id'] == '4' || $_SESSION['position_id'] == '1') { ?>
    <form action="preview.php" method="post">
        <?php if ($_SESSION['position_id'] == '3'){ ?>
            <span style="color: white;">Filter by region: </span>
            <select name="selected" id="region" onchange="showRegion(this.value)">
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
            <select name="selected" id="location" onchange="showLocation(this.value)">
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
            <select name="selected" id="region" onchange="showLocation(this.value)">
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
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>

            <?php

            $sql = "SELECT * FROM schedules 
                        INNER JOIN locations ON schedules.location_id = locations.location_id
                        INNER JOIN employees ON schedules.employee_id = employees.employee_id AND locations.location_id = '{$_SESSION['location_id']}' AND schedules.status= 'unlocked' ORDER BY schedules.schedule_id DESC LIMIT 8";

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
            }
            ?>

            </tbody>
        </table>

        <div id="selected"></div>

    </form>
</div>

<?php } else {
    echo "<h1 class='text-center font-weight-bold'>You are not allowed to see this section.</h1>";
} ?>

<?php include '../includes/footer.php'; ?>



