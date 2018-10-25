<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require_once '../includes/db.php'
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>

    <script>
        var count = 0;

        function addFunc() {
            count += 1;
            var click = document.getElementById('clicks').innerHTML = count;
            var btn = document.getElementById('add');
            if (count >= 20) {
                btn.disabled = true;
            }
        }

        function deleteFunc() {
            count -= 1;
            var click = document.getElementById('clicks').innerHTML = count;
            var btn = document.getElementById('add');
            if (count <= 20) {
                btn.disabled = false;
            }
        }
    </script>

    <div>
        <br>
        <h3 class="text-center font-weight-bold text-white">Holidays</h3><br>
        <?php if ($_SESSION['position_id'] == '3' || $_SESSION['position_id'] == '4' || $_SESSION['position_id'] == '1') { ?>

        <form class="repeater" name="form" action="insert_exe.php" method="post">
            <div data-repeater-list="category-group">
                <div data-repeater-item>
                    <div class="new">

                        <table class="table table-striped table-dark">

                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Holiday</th>
                                <th scope="col">Celebrated by</th>
                            </tr>
                            <tr>
                                <td><input type="text" id="holiday_date" name="holiday_date" value=""
                                           required style="width: 147px"></td>
                                <td><input type="text" name="holiday" id="holiday"></td>

                                <td><select name="celebrated" id="celebrated" required>
                                        <option value="">--Select--</option>

                                        <?php

                                        $sql_cel = "SELECT * FROM celebrated";

                                        $result_cel = $conn->query($sql_cel);
                                        while ($row_cel = $result_cel->fetch_object()) {
                                            $celebrated_id = $row_cel->celebrated_id;
                                            $celebrated = $row_cel->celebrated_by;

                                            echo "<option name='city' value='$celebrated_id'>$celebrated</option>";
                                        }


                                        ?>
                                    </select></td>
                            </tr>
                        </table>
                        <input data-repeater-delete type="button" onclick="deleteFunc()" value="Delete"/>
                    </div>
                </div>
            </div>
            <input data-repeater-create type="button" id="add" onclick="addFunc()" value="Add"/><input type="hidden"
                                                                                                         id="clicks">

            <tr>
                <td colspan="3"><input class="btn btn-danger btn-block" type="submit" name="submit" value="Insert"></td>

            </tr>
            <script>

                $(document).ready(function () {
                    var ids = 1; //id numbers for add. datepickers
                    $('#add').click(function () {
                        $('#holiday_date:last').attr('id', ids);// each datepicker must have a unique id.
                        ids++; // increase the id numbers
                    });
                });
                $(document).on('focus', "#holiday_date", function () { //bind to all instances of id "monday_date".
                    $(this).datepicker({dateFormat: 'dd-mm-yy', firstDay: '1', dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ], monthNames: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec" ]});
                });
            </script>
        </form>
    </div>

<?php } else {
    echo "<h1 class='text-center font-weight-bold'>You are not allowed to see this section.</h1>";
} ?>


<?php include '../includes/footer.php'; ?>