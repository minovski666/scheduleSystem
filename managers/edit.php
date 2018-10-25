<?php require_once '../includes/db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}


?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>
<br><h3 class="text-center font-weight-bold text-white">Managers</h3><br>
<?php if ($_SESSION['position_id'] == '3') { ?>
    <div>
        <form name="form" action="edit_exe.php" method="post">
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Location</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM managers where manager_id='" . $_GET['id'] . "' AND position_id='4'";

                $result = $conn->query($sql);
                while ($row = $result->fetch_object()) {
                    $id = $row->manager_id;
                    $name = $row->name;
                    $lastName = $row->last_name;
                    $username = $row->username;
                    $password = $row->password;
                    $re_id = $row->region_id;

                    echo "<tr>
            
            <input type='hidden' name='manager_id' value='$id'>
            <td>$name</td>
            <td><input type='text' name='last_name' value='$lastName' required></td>
            <td><input type='text' name='username' value='$username' required></td>
            <td><input type='password' name='password' value='$password' required></td>
            <td><select name='city' id='city' required>";


                    $sql2 = "SELECT * FROM regions WHERE region_id>1";
                    $result2 = $conn->query($sql2);
                    while ($row2 = $result2->fetch_object()) {
                        $region_id = $row2->region_id;
                        $region = $row2->region;

                        if ($region_id == $re_id) {

                            echo "<option selected value='{$region_id}'>$region</option>";
                        } else {
                            echo "<option value='{$region_id}'>$region</option>";
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
