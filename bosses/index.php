<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}

require_once '../includes/db.php';
include '../includes/header.php';
include '../includes/nav.php';

?>

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

</script>


<br><h3 class="text-center font-weight-bold text-white">Bosses</h3><br>
<?php if ($_SESSION['position_id'] == '3' || $_SESSION['position_id'] == '4') { ?>
    <div>
        <form action="" method="post">

            <?php if ($_SESSION['position_id'] == '3') { ?>
                <span style="color: white;">Filter by region: </span>
                <select name="selected" id="region" onchange="showRegion(this.value)">
                    <option name="region_id" id="region_id">Select region</option>
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
            <?php } ?>
            <?php if ($_SESSION['position_id'] == '4') { ?>

            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Location</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM managers INNER JOIN locations ON managers.location_id = locations.location_id WHERE managers.region_id='" . $_SESSION['region_id'] . "' AND (managers.position_id='2' OR managers.position_id='1')";


                $result = $conn->query($sql);
                while ($row = $result->fetch_object()) {
                    $id = $row->manager_id;
                    $name = $row->name;
                    $lastName = $row->last_name;
                    $position = $row->position_id;
                    $username = $row->username;
                    $location = $row->location;

                    echo "<tr>
            <td>$name</td>
            <td>$lastName</td>
            <td>$username</td>
            <td>$location</td>
            <td><a class='btn btn-info' href='edit.php?id=$id'>Edit</a></td>
            <td><a class='btn btn-danger' onclick='return delete_ad($id)'>Delete</a></td>
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
