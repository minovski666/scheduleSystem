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
            if (count >= 3) {
                btn.disabled = true;
            }
        }

        function deleteFunc() {
            count -= 1;
            var click = document.getElementById('clicks').innerHTML = count;
            var btn = document.getElementById('add');
            if (count <= 3) {
                btn.disabled = false;
            }
        }
    </script>

    <div>
        <br>
        <h3 class="text-center font-weight-bold text-white">Schedules</h3><br>
        <?php if ($_SESSION['position_id'] == '3' || $_SESSION['position_id'] == '4' || $_SESSION['position_id'] == '1') { ?>

        <form class="repeater" name="form" action="insert_exe.php" method="post">
            <div data-repeater-list="category-group">
                <div data-repeater-item>
                    <div class="new">

                        <table class="table table-striped table-dark">

                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Location</th>
                            </tr>
                            <tr>
                                <td><select name="employees" id="employees" required>
                                        <option value="">--Select--</option>

                                        <?php
                                        if ($_SESSION['position_id'] == '3') {
                                            $sql_employees = "SELECT * FROM employees ";
                                        } elseif ($_SESSION['position_id'] == '4') {
                                            $sql_employees = "SELECT * FROM employees WHERE region_id = '" . $_SESSION['region_id'] . "'";
                                        } else {
                                            $sql_employees = "SELECT * FROM employees WHERE location_id = '" . $_SESSION['location_id'] . "'";
                                        }
                                        $result_employees = $conn->query($sql_employees);
                                        while ($row_employees = $result_employees->fetch_object()) {
                                            $employee_id = $row_employees->employee_id;
                                            $name = $row_employees->name;
                                            $last_name = $row_employees->last_name;

                                            echo "<option name='employee_id' value='$employee_id'>$name $last_name</option>";
                                        }
                                        ?>
                                    </select></td>

                                <td><select name="city" id="city" required>
                                        <option value="">--Select--</option>

                                        <?php
                                        if ($_SESSION['position_id'] == '3') {
                                            $sql_region = "SELECT * FROM locations WHERE location_id>1";
                                        } elseif ($_SESSION['position_id'] == '4') {
                                            $sql_region = "SELECT * FROM locations WHERE region_id = '" . $_SESSION['region_id'] . "' AND region_id>1";
                                        } else {
                                            $sql_region = "SELECT * FROM locations WHERE location_id = '" . $_SESSION['location_id'] . "' AND location_id>1";
                                        }
                                        $result_region = $conn->query($sql_region);
                                        while ($row_region = $result_region->fetch_object()) {
                                            $location_id = $row_region->location_id;
                                            $location = $row_region->location;
                                            $region_id = $row_region->region_id;

                                            echo "<option name='city' value='$location_id:$region_id'>$location</option>";
                                        }


                                        ?>
                                    </select></td>
                            </tr>
                            <tr>
                                <th scope="col">Monday</th>
                                <th scope="col">Tuesday</th>
                                <th scope="col">Wednesday</th>
                                <th scope="col">Thursday</th>
                                <th scope="col">Friday</th>
                                <th scope="col">Saturday</th>
                                <th scope="col">Sunday</th>
                            </tr>
                            <tr id="dates">
                                <td><input type="text" id="monday_date" name="monday_date" value=""
                                           required style="width: 147px"></td>
                                <td><input type="text" id="tuesday_date" name="tuesday_date"
                                           value="" required style="width: 147px"></td>
                                <td><input type="text" id="wednesday_date" name="wednesday_date"
                                           value="" required style="width: 147px"></td>
                                <td><input type="text" id="thursday_date" name="thursday_date"
                                           value="" required style="width: 147px"></td>
                                <td><input type="text" id="friday_date" name="friday_date" value=""
                                           required style="width: 147px"></td>
                                <td><input type="text" id="saturday_date" name="saturday_date"
                                           value="" required style="width: 147px"></td>
                                <td><input type="text" id="sunday_date" name="sunday_date" value=""
                                           required style="width: 147px"></td>
                            </tr>
                            <td><select name="monday" id="monday" required>
                                    <option value="">--Select--</option>

                                    <?php

                                    $sql_monday = "SELECT * FROM shifts";
                                    $result_monday = $conn->query($sql_monday);
                                    while ($row_monday = $result_monday->fetch_object()) {
                                        $shift_id_monday = $row_monday->shift_id;
                                        $shift_monday = $row_monday->shift;
                                        $hours_monday = $row_monday->hours;

                                        echo "<option id='monday' name='$shift_id_monday' value='$hours_monday:$shift_monday'>$shift_monday</option>";
                                    }
                                    ?>
                                </select></td>

                            <td><select name="tuesday" id="tuesday" required>
                                    <option value="">--Select--</option>

                                    <?php

                                    $sql_tuesday = "SELECT * FROM shifts";
                                    $result_tuesday = $conn->query($sql_tuesday);
                                    while ($row_tuesday = $result_tuesday->fetch_object()) {
                                        $shift_id_tuesday = $row_tuesday->shift_id;
                                        $shift_tuesday = $row_tuesday->shift;
                                        $hours_tuesday = $row_tuesday->hours;

                                        echo "<option name='tuesday' id='$shift_id_tuesday' value='$hours_tuesday:$shift_tuesday'>$shift_tuesday</option>";
                                    }
                                    ?>
                                </select></td>

                            <td><select name="wednesday" id="wednesday" required>
                                    <option value="">--Select--</option>

                                    <?php

                                    $sql_wednesday = "SELECT * FROM shifts";
                                    $result_wednesday = $conn->query($sql_wednesday);
                                    while ($row_wednesday = $result_wednesday->fetch_object()) {
                                        $shift_id_wednesday = $row_wednesday->shift_id;
                                        $shift_wednesday = $row_wednesday->shift;
                                        $hours_wednesday = $row_wednesday->hours;

                                        echo "<option name='wednesday' id='$shift_id_wednesday' value='$hours_wednesday:$shift_wednesday'>$shift_wednesday</option>";
                                    }
                                    ?>
                                </select></td>

                            <td><select name="thursday" id="thursday" required>
                                    <option value="">--Select--</option>

                                    <?php

                                    $sql_thursday = "SELECT * FROM shifts";
                                    $result_thursday = $conn->query($sql_thursday);
                                    while ($row_thursday = $result_thursday->fetch_object()) {
                                        $shift_id_thursday = $row_thursday->shift_id;
                                        $shift_thursday = $row_thursday->shift;
                                        $hours_thursday = $row_thursday->hours;

                                        echo "<option name='thursday' id='$shift_id_thursday' value='$hours_thursday:$shift_thursday'>$shift_thursday</option>";
                                    }
                                    ?>
                                </select></td>

                            <td><select name="friday" id="friday" required>
                                    <option value="">--Select--</option>

                                    <?php

                                    $sql_friday = "SELECT * FROM shifts";
                                    $result_friday = $conn->query($sql_friday);
                                    while ($row_friday = $result_friday->fetch_object()) {
                                        $shift_id_friday = $row_friday->shift_id;
                                        $shift_friday = $row_friday->shift;
                                        $hours_friday = $row_friday->hours;

                                        echo "<option name='friday' id='$shift_id_friday' value='$hours_friday:$shift_friday'>$shift_friday</option>";
                                    }
                                    ?>
                                </select></td>

                            <td><select name="saturday" id="saturday" required>
                                    <option value="">--Select--</option>

                                    <?php

                                    $sql_saturday = "SELECT * FROM shifts";
                                    $result_saturday = $conn->query($sql_saturday);
                                    while ($row_saturday = $result_saturday->fetch_object()) {
                                        $shift_id_saturday = $row_saturday->shift_id;
                                        $shift_saturday = $row_saturday->shift;
                                        $hours_saturday = $row_saturday->hours;

                                        echo "<option name='saturday' id='$shift_id_saturday' value='$hours_saturday:$shift_saturday'>$shift_saturday</option>";
                                    }
                                    ?>
                                </select></td>

                            <td><select name="sunday" id="sunday" required>
                                    <option value="">--Select--</option>

                                    <?php

                                    $sql_sunday = "SELECT * FROM shifts";
                                    $result_sunday = $conn->query($sql_sunday);
                                    while ($row_sunday = $result_sunday->fetch_object()) {
                                        $shift_id_sunday = $row_sunday->shift_id;
                                        $shift_sunday = $row_sunday->shift;
                                        $hours_sunday = $row_sunday->hours;

                                        echo "<option name='sunday' id='$shift_id_sunday' value='$hours_sunday:$shift_sunday'>$shift_sunday</option>";
                                    }
                                    ?>
                                </select></td>

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
                        $('#monday_date:last').attr('id', ids);// each datepicker must have a unique id.
                        $('#tuesday_date:last').attr('id', ids);// each datepicker must have a unique id.
                        $('#wednesday_date:last').attr('id', ids);// each datepicker must have a unique id.
                        $('#thursday_date:last').attr('id', ids);// each datepicker must have a unique id.
                        $('#friday_date:last').attr('id', ids);// each datepicker must have a unique id.
                        $('#saturday_date:last').attr('id', ids);// each datepicker must have a unique id.
                        $('#sunday_date:last').attr('id', ids);// each datepicker must have a unique id.
                        ids++; // increase the id numbers
                    });
                });
                $(document).on('focus', "#monday_date", function () { //bind to all instances of id "monday_date".
                    $(this).datepicker({dateFormat: 'dd-mm-yy', firstDay: '1', dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ], monthNames: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec" ]});
                });

                $(document).on('focus', "#tuesday_date", function () { //bind to all instances of id "tuesday_date".
                    $(this).datepicker({dateFormat: 'dd-mm-yy', firstDay: '1', dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ], monthNames: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec" ]});
                });

                $(document).on('focus', "#wednesday_date", function () { //bind to all instances of id "wednesday_date".
                    $(this).datepicker({dateFormat: 'dd-mm-yy', firstDay: '1', dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ], monthNames: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec" ]});
                });

                $(document).on('focus', "#thursday_date", function () { //bind to all instances of id "thursday_date".
                    $(this).datepicker({dateFormat: 'dd-mm-yy', firstDay: '1', dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ], monthNames: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec" ]});
                });

                $(document).on('focus', "#friday_date", function () { //bind to all instances of id "friday_date".
                    $(this).datepicker({dateFormat: 'dd-mm-yy', firstDay: '1', dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ], monthNames: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec" ]});
                });

                $(document).on('focus', "#saturday_date", function () { //bind to all instances of id "saturday_date".
                    $(this).datepicker({dateFormat: 'dd-mm-yy', firstDay: '1', dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ], monthNames: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec" ]});
                });

                $(document).on('focus', "#sunday_date", function () { //bind to all instances of id "sunday_date".
                    $(this).datepicker({dateFormat: 'dd-mm-yy', firstDay: '1', dayNamesMin: [ "Su", "Mo", "Tu", "We", "Th", "Fr", "Sa" ], monthNames: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Noe", "Dec" ]});
                });

            </script>
        </form>
    </div>

<?php } else {
    echo "<h1 class='text-center font-weight-bold'>You are not allowed to see this section.</h1>";
} ?>


<?php include '../includes/footer.php'; ?>