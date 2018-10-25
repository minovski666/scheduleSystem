<?php require_once '../includes/db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}

?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

    <div>
    <br><h3 class="text-center font-weight-bold text-white">Employees</h3><br>
<?php if ($_SESSION['position_id'] == '3' || $_SESSION['position_id'] == '4' || $_SESSION['position_id'] == '1') { ?>
    <form name="form" action="edit_exe.php" method="post">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Last name</th>
                <th scope="col">Location</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM employees where employee_id='" . $_GET['id'] . "'";

            $result = $conn->query($sql);
            while ($row = $result->fetch_object()) {
                $id = $row->employee_id;
                $name = $row->name;
                $lastName = $row->last_name;
                $lo_id = $row->location_id;

                echo "<tr>
            
            <input type='hidden' name='employee_id' value='$id'>
            <td>$name</td>
            <td><input type='text' name='last_name' value='$lastName' required></td>
            
                    <td><select name='city' id='city' required>";

                if ($_SESSION['position_id'] == '3') {
                    $sql3 = "SELECT * FROM locations WHERE location_id>1";
                } else {
                    $sql3 = "SELECT * FROM locations WHERE region_id = '{$_SESSION['region_id']}'";
                }
                $result3 = $conn->query($sql3);
                while ($row3 = $result3->fetch_object()) {
                    $location_id = $row3->location_id;
                    $location = $row3->location;
                    $region_id = $row3->region_id;

                    if ($location_id == $lo_id) {

                        echo "<option selected value='$region_id:$location_id'>$location</option>";
                    } else {
                        echo "<option value='$region_id:$location_id'>$location</option>";
                    }
                }

                echo "</select></td>

            <td><input class='btn btn-danger' type='submit' name='submit' value='Edit'></td>
        </tr>";

            }

            ?>

            </tbody>
        </table>
    </form>
    </div>

<?php } else {
    echo "<h1 class='text-center font-weight-bold'>You are not allowed to see this section.</h1>";
} ?>
<?php include '../includes/footer.php'; ?>