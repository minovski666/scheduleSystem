<?php require_once '../includes/db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}

?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

    <div>
    <br><h3 class="text-center font-weight-bold text-white">Regions</h3><br>
<?php if ($_SESSION['position_id'] == '3') { ?>
    <form name="form" action="insert_exe.php" method="post">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">Region</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                <td><input type="text" name="region" value="" required></td>
                <td><input class="btn btn-danger" type="submit" name="submit" value="Insert"></td>
            </tr>

            </tbody>
        </table>
    </form>
    </div>

<?php } else {
    echo "<h1 class='text-center font-weight-bold'>You are not allowed to see this section.</h1>";
} ?>
<?php include '../includes/footer.php'; ?>