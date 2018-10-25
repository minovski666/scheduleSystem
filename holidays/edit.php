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
    <h3 class="text-center font-weight-bold text-white">Holidays</h3><br>
    <?php if ($_SESSION['position_id'] == '3'){ ?>

    <form name="form" action="edit_exe.php" method="post">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Holiday</th>
                <th scope="col">Celebrated by</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM holidays INNER JOIN celebrated ON holidays.celebrated_id = celebrated.celebrated_id ";

            $result = $conn->query($sql);
            while ($row = $result->fetch_object()) {
                $id = $row->holiday_id;
                $holiday = $row->holiday;
                $holiday_date = $row->holiday_date;
                $celebrated = $row->celebrated_by;

                echo "<tr>
            
            <input type='hidden' name='holiday_id' value='$id'>
            <td><input type='text' id='holiday_date' name='holiday_date' value='$holiday_date'
                                           required style=\"width: 147px\"></td>
            <td><input type='text' name='holiday' value='$holiday' required></td>";
            }
            ?>
            <td><select name="celebrated" id="celebrated" required>
                    <?php

                    $sql_cel = "SELECT * FROM celebrated";
                    $result_cel = $conn->query($sql_cel);
                    while ($row_cel = $result_cel->fetch_object()) {
                        $celebrated_id = $row_cel->celebrated_id;
                        $celebrated_by = $row_cel->celebrated_by;

                        if ($celebrated == $celebrated_by) {

                            echo "<option selected value='$celebrated_id'>$celebrated_by</option>";
                        } else {
                            echo "<option value='$celebrated_id'>$celebrated_by</option>";
                        }
                    }
                    ?>
                </select></td>






            <td><input class='btn btn-danger' type='submit' name='submit' value='Edit'></td>
        </tr>";




            </tbody>
        </table>
    </form>
</div>
    <script>
        $(document).on('focus', "#holiday_date", function () { //bind to all instances of id "monday_date".
            $(this).datepicker({dateFormat: 'dd-mm-yy', firstDay: '1', dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ], monthNames: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec" ]});
        });
    </script>

<?php } else {
    echo "<h1 class='text-center font-weight-bold'>You are not allowed to see this section.</h1>";
} ?>
<?php include '../includes/footer.php'; ?>

