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
<?php if ($_SESSION['position_id'] == '3') { ?>
    <form action="" method="post">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">Location</th>
                <th scope="col">Code</th>
                <th scope="col">Region</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php


            if (empty($_GET['region_id'])) {

                $sql = "SELECT * FROM locations INNER JOIN regions ON regions.region_id = locations.region_id WHERE location_id>1 ORDER BY location_id DESC ";

            } elseif (isset($_GET['region_id'])) {

                $sql = "SELECT * FROM locations INNER JOIN regions ON regions.region_id = locations.region_id WHERE location_id>1 AND locations.region_id = '$value' ORDER BY location_id DESC ";

            }
            $result = $conn->query($sql);
            while ($row = $result->fetch_object()) {
                $id = $row->location_id;
                $location_code = $row->location_code;
                $location = $row->location;
                $region = $row->region;
                echo "<tr>
                    <td>$location</td>
                    <td>$location_code</td>
                    <td>$region</td>
                    <td><a class='btn btn-info' href='edit.php?id=$id'>Edit</a></td>
                    <td><a class='btn btn-danger' onclick='return delete_ad($id)'>Delete</a></td>
                </tr>";

            }

            ?>

            </tbody>
        </table>
    </form>
    </div>
<?php } ?>