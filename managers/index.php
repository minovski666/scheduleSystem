<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}

require_once '../includes/db.php';
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>


<br><h3 class="text-center font-weight-bold text-white">Managers</h3><br>
<?php if ($_SESSION['position_id'] == '3') { ?>
    <div>
        <form action="" method="post">
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Region</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($_SESSION['position_id'] == '3') {
                    $sql = "SELECT * FROM managers INNER JOIN regions ON managers.region_id = regions.region_id WHERE position_id='4'";
                } else {
                    $sql = "SELECT * FROM managers INNER JOIN regions ON managers.region_id = regions.region_id WHERE position_id='4' AND managers.region_id='" . $_SESSION['region_id'] . "'";
                }
                $result = $conn->query($sql);
                while ($row = $result->fetch_object()) {
                    $id = $row->manager_id;
                    $name = $row->name;
                    $lastName = $row->last_name;
                    $username = $row->username;
                    $region = $row->region;

                    echo "<tr>
            <td>$name</td>
            <td>$lastName</td>
            <td>$username</td>
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

<?php } else {
    echo "<h1 class='text-center font-weight-bold'>You are not allowed to see this section.</h1>";
} ?>
<?php include '../includes/footer.php'; ?>
