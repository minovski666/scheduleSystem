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
                    <th scope="col">Code</th>
                    <th scope="col">Location</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php


                if (empty($_GET['region_id'])) {

                    $sql = "SELECT * FROM employees INNER JOIN locations ON employees.location_id = locations.location_id ORDER BY employee_id DESC  ";

                } elseif (isset($_GET['region_id'])) {

                    $sql = "SELECT * FROM employees INNER JOIN locations ON employees.location_id = locations.location_id AND employees.region_id = '$value' ORDER BY employee_id DESC  ";

                }
                $result = $conn->query($sql);
                while ($row = $result->fetch_object()) {
                    $id = $row->employee_id;
                    $employee_code = $row->employee_code;
                    $name = $row->name;
                    $lastName = $row->last_name;
                    $location = $row->location;


                    echo "<tr>
            <td>$name</td>
            <td>$lastName</td>
            <td>$employee_code</td>
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