<?php require_once '../includes/db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}

?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>
<br><h3 class="text-center font-weight-bold text-white">Employees</h3><br>
<?php if ($_SESSION['position_id'] == '3' || $_SESSION['position_id'] == '4' || $_SESSION['position_id'] == '1') { ?>
    <div>
        <form name="form" action="insert_exe.php" method="post">
            <div id="section">
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Code</th>
                    <th scope="col">Nationality</th>
                    <th scope="col">Religion</th>
                    <th scope="col">Location</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><input type="text" name="first_name" value="" required></td>
                    <td><input type="text" name="last_name" value="" required></td>
                    <td><input type="text" name="employee_code" value="" required></td>
                    <td><select name="nationality" id="nationality">
                            <option value="">--Select--</option>

                            <?php

                            $sql_nat = "SELECT * FROM celebrated LIMIT 8";

                            $result_nat = $conn->query($sql_nat);
                            while ($row_nat = $result_nat->fetch_object()){
                                $nat_id = $row_nat->celebrated_id;
                                $nat = $row_nat->celebrated_by;

                                echo "<option name='nat_id' value='$nat_id'>$nat</option>";
                            }

                            ?>

                        </select></td>
                    <td><select name="religion" id="religion">

                            <option value="">--Select--</option>

                            <?php

                            $sql_religion = "SELECT * FROM celebrated WHERE celebrated_id > 11";

                            $result_religion = $conn->query($sql_religion);
                            while ($row_religion = $result_religion->fetch_object()){
                                $religion_id = $row_religion->celebrated_id;
                                $religion = $row_religion->celebrated_by;

                                echo "<option name='religion_id' value='$religion_id'>$religion</option>";
                            }

                            ?>

                        </select></td>
                    <td><select name="city" id="city" required>
                            <option value="">--Select--</option>

                            <?php

                            if ($_SESSION['position_id'] == '3') {
                                $sql3 = "SELECT * FROM locations WHERE location_id>1";
                            } elseif ($_SESSION['position_id'] == '4') {
                                $sql3 = "SELECT * FROM locations WHERE region_id = '{$_SESSION['region_id']}'";
                            } else {
                                $sql3 = "SELECT * FROM locations WHERE location_id = '{$_SESSION['location_id']}'";
                            }
                            $result3 = $conn->query($sql3);
                            while ($row3 = $result3->fetch_object()) {
                                $region_id = $row3->region_id;
                                $location = $row3->location;
                                $location_id = $row3->location_id;

                                echo "<option name='region_id' value='$region_id:$location_id'>$location</option>";
                            }

                            ?>

                        </select></td>
                    <td><input class="btn btn-danger" type="submit" name="submit" value="Insert"></td>
                </tr>

                </tbody>
            </table>
            </div>
        </form>
    </div>

<?php } else {
    echo "<h1 class='text-center font-weight-bold'>You are not allowed to see this section.</h1>";
} ?>
<?php include '../includes/footer.php'; ?>
