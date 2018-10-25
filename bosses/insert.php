<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require_once '../includes/db.php';

?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>
<br><h3 class="text-center font-weight-bold text-white">Bosses</h3><br>
<?php
if ($_SESSION['position_id'] == '3' || $_SESSION['position_id'] == '4') {
    ?>
    <div>
        <form name="form" action="insert_exe.php" method="post">
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Location</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>

                </tr>
                </thead>
                <tbody>
                <tr>


                    <td><input type="text" name="first_name" value="" required></td>
                    <td><input type="text" name="last_name" value="" required></td>
                    <td><select name="city" id="city" required>
                            <option value="">--Select--</option>

                            <?php
                            if ($_SESSION['position_id'] == '3') {
                                $sql2 = "SELECT * FROM locations WHERE location_id>1";
                            } elseif ($_SESSION['position_id'] == '4') {
                                $sql2 = "SELECT * FROM locations WHERE location_id>1 AND region_id = '" . $_SESSION['region_id'] . "'";
                            } else {
                                $sql2 = "SELECT * FROM locations WHERE location_id>1 AND location_id = '" . $_SESSION['location_id'] . "'";
                            }


                            $result2 = $conn->query($sql2);
                            while ($row2 = $result2->fetch_object()) {
                                $location_id = $row2->location_id;
                                $location = $row2->location;
                                $region_id = $row2->region_id;

                                echo "<option name='region_id' value='$location_id:$region_id'>$location</option>";
                            }

                            ?>
                        </select></td>

                    <td><input type="text" name="username" value="" required></td>
                    <td><input type="password" name="password" value="" required></td>
                </tr>
                <tr>
                    <td colspan="6"><input class="btn btn-danger" type="submit" name="submit" value="Insert"></td>
                </tr>

                </tbody>
            </table>
        </form>
    </div>

<?php } else {
    echo "<h1 class='text-center font-weight-bold'>You are not allowed to see this section.</h1>";
} ?>
<?php include '../includes/footer.php'; ?>
