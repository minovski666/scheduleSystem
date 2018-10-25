<?php require_once '../includes/db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}


?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

<div>
    <br>
    <h3 class="text-center font-weight-bold text-white">Locations</h3><br>
    <?php if ($_SESSION['position_id'] == '3'){ ?>
    <form name="form" action="edit_exe.php" method="post">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">Location</th>
                <th scope="col">Region</th>
                <th scope="col">Code</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM locations where location_id='" . $_GET['id'] . "'";

            $result = $conn->query($sql);
            while ($row = $result->fetch_object()) {
                $id = $row->location_id;
                $location_code = $row->location_code;
                $location = $row->location;
                $reg_id = $row->region_id;
                echo "<tr>
            
            <input type='hidden' name='location_id' value='$id'>
            <td><input type='text' name='city' value='$location' required></td>
            <td><select name='region' id='region' required>";

                $sql2 = "SELECT * FROM regions WHERE region_id>1";
                $result2 = $conn->query($sql2);
                while ($row2 = $result2->fetch_object()) {
                    $region_id = $row2->region_id;
                    $region = $row2->region;

                    if ($region_id == $reg_id) {

                        echo "<option selected value='{$region_id}'>$region</option>";
                    } else {
                        echo "<option value='{$region_id}'>$region</option>";
                    }
                }
                echo "<td><input type='text' name='location_code' value='$location_code' required></td>";
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
