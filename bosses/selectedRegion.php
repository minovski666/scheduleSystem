<?php require_once '../includes/db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}

?>
<?php
$value = $_GET['region_id'];
?>


    <div>
        <?php //if ($_SESSION['position_id'] == '3') { ?>
        <form action="" method="post">
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


                if (empty($_GET['region_id'])) {

                    $sql = "SELECT * FROM managers INNER JOIN locations ON managers.location_id = locations.location_id WHERE (managers.position_id='2' OR managers.position_id='1')";

                } elseif (isset($_GET['region_id'])) {

                    $sql = "SELECT * FROM managers INNER JOIN locations ON managers.location_id = locations.location_id WHERE managers.region_id = '$value' AND (managers.position_id='2' OR managers.position_id='1')";

                }
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

                ?>

                </tbody>
            </table>
        </form>
    </div>
<?php //} ?>