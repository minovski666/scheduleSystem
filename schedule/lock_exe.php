<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}
require_once '../includes/db.php';
require_once '../includes/class.php';

$object_edit = new Database();
$table_name = " schedules ";


$number_of_value = count($_POST['monday_date']);

for ($i = 0; $i < $number_of_value; $i++) {


    $monday_html = htmlentities($_POST['monday_date'][$i]);
    $monday_date = date('Y-m-d', strtotime($monday_html));

    $tuesday_html = htmlentities($_POST['tuesday_date'][$i]);
    $tuesday_date = date('Y-m-d', strtotime($tuesday_html));

    $wednesday_html = htmlentities($_POST['wednesday_date'][$i]);
    $wednesday_date = date('Y-m-d', strtotime($wednesday_html));

    $thursday_html = htmlentities($_POST['thursday_date'][$i]);
    $thursday_date = date('Y-m-d', strtotime($thursday_html));

    $friday_html = htmlentities($_POST['friday_date'][$i]);
    $friday_date = date('Y-m-d', strtotime($friday_html));

    $saturday_html = htmlentities($_POST['saturday_date'][$i]);
    $saturday_date = date('Y-m-d', strtotime($saturday_html));

    $sunday_html = htmlentities($_POST['sunday_date'][$i]);
    $sunday_date = date('Y-m-d', strtotime($sunday_html));


    $monday = "" . $_POST['monday'][$i] . "";
    $monday_value = preg_split('[:]', $monday)[0];
    $monday_text = preg_split('[:]', $monday)[1];


    $tuesday = "" . $_POST['tuesday'][$i] . "";
    $tuesday_value = preg_split('[:]', $tuesday)[0];
    $tuesday_text = preg_split('[:]', $tuesday)[1];


    $wednesday = "" . $_POST['wednesday'][$i] . "";
    $wednesday_value = preg_split('[:]', $wednesday)[0];
    $wednesday_text = preg_split('[:]', $wednesday)[1];


    $thursday = "" . $_POST['thursday'][$i] . "";
    $thursday_value = preg_split('[:]', $thursday)[0];
    $thursday_text = preg_split('[:]', $thursday)[1];


    $friday = "" . $_POST['friday'][$i] . "";
    $friday_value = preg_split('[:]', $friday)[0];
    $friday_text = preg_split('[:]', $friday)[1];


    $saturday = "" . $_POST['saturday'][$i] . "";
    $saturday_value = preg_split('[:]', $saturday)[0];
    $saturday_text = preg_split('[:]', $saturday)[1];


    $sunday = "" . $_POST['sunday'][$i] . "";
    $sunday_value = preg_split('[:]', $sunday)[0];
    $sunday_text = preg_split('[:]', $sunday)[1];

    $place = "" . $_POST['city'][$i] . "";
    $location = preg_split('[:]', $place)[0];
    $region = preg_split('[:]', $place)[1];
    $employee = "" . $_POST['employees'][$i] . "";

    $column_value[$i] = " location_id='$location', region_id= '$region', employee_id='$employee',monday='$monday_value',monday_shift='$monday_text',monday_date='$monday_date',tuesday='$tuesday_value',tuesday_shift='$tuesday_text',tuesday_date='$tuesday_date',wednesday='$wednesday_value',wednesday_shift='$wednesday_text',wednesday_date='$wednesday_date',thursday='$thursday_value',thursday_shift='$thursday_text',thursday_date='$thursday_date',friday='$friday_value',friday_shift='$friday_text',friday_date='$friday_date',saturday='$saturday_value',saturday_shift='$saturday_text',saturday_date='$saturday_date',sunday='$sunday_value',sunday_shift='$sunday_text',sunday_date='$sunday_date',status='locked' ";


    $pk = " schedule_id ";
    $pk_value = $_POST['schedule_id'][$i];

    //update records database with pk_value

    $object_edit->editINT($table_name, $column_value[$i], $pk, $pk_value);

}
$object = new Database();
$table_name = " schedule2 ";
$column_name = " employee_id, location_id, region_id, shift, shift_lenght, shift_night, holiday_day, holiday_night, day_date ";


for ($i = 0; $i < $number_of_value; $i++) {


    $monday_html = htmlentities($_POST['monday_date'][$i]);
    $monday_date = date('Y-m-d', strtotime($monday_html));

    $tuesday_html = htmlentities($_POST['tuesday_date'][$i]);
    $tuesday_date = date('Y-m-d', strtotime($tuesday_html));

    $wednesday_html = htmlentities($_POST['wednesday_date'][$i]);
    $wednesday_date = date('Y-m-d', strtotime($wednesday_html));

    $thursday_html = htmlentities($_POST['thursday_date'][$i]);
    $thursday_date = date('Y-m-d', strtotime($thursday_html));

    $friday_html = htmlentities($_POST['friday_date'][$i]);
    $friday_date = date('Y-m-d', strtotime($friday_html));

    $saturday_html = htmlentities($_POST['saturday_date'][$i]);
    $saturday_date = date('Y-m-d', strtotime($saturday_html));

    $sunday_html = htmlentities($_POST['sunday_date'][$i]);
    $sunday_date = date('Y-m-d', strtotime($sunday_html));


    $employee = $_POST['employees'][$i];
    $employees = preg_split('[:]', $employee)[0];
    $nationality = preg_split('[:]', $employee)[1];
    $religion = preg_split('[:]', $employee)[2];

    $monday = $_POST['monday'][$i];
    $monday_value = preg_split('[:]', $monday)[0];
    $monday_text = preg_split('[:]', $monday)[1];

    $tuesday = $_POST['tuesday'][$i];
    $tuesday_value = preg_split('[:]', $tuesday)[0];
    $tuesday_text = preg_split('[:]', $tuesday)[1];

    $wednesday = $_POST['wednesday'][$i];
    $wednesday_value = preg_split('[:]', $wednesday)[0];
    $wednesday_text = preg_split('[:]', $wednesday)[1];

    $thursday = $_POST['thursday'][$i];
    $thursday_value = preg_split('[:]', $thursday)[0];
    $thursday_text = preg_split('[:]', $thursday)[1];

    $friday = $_POST['friday'][$i];
    $friday_value = preg_split('[:]', $friday)[0];
    $friday_text = preg_split('[:]', $friday)[1];

    $saturday = $_POST['saturday'][$i];
    $saturday_value = preg_split('[:]', $saturday)[0];
    $saturday_text = preg_split('[:]', $saturday)[1];

    $sunday = $_POST['sunday'][$i];
    $sunday_value = preg_split('[:]', $sunday)[0];
    $sunday_text = preg_split('[:]', $sunday)[1];


    $city = $_POST['city'][$i];
    $city_id = preg_split('[:]', $city)[0];
    $region_id = preg_split('[:]', $city)[1];


    $sql = "SELECT holiday_date, celebrated_id FROM holidays ";
    $result = mysqli_query($conn, $sql);
    $holiday_dates = array();
    $celebrated_ids = array();
    $all = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $holiday_dates[] = $row['holiday_date'];
        $celebrated_ids[] = $row['celebrated_id'];
        $all[] = $row;
    }


    $num = mysqli_num_rows($result);

    $holiday_monday_day = '';
    $holiday_monday_night = '';
    $monday_day = '';
    $monday_night = '';
    foreach ($holiday_dates as $holiday_date) {

        if (in_array($monday_date, $holiday_dates)) {
            $sql = "SELECT celebrated_id FROM holidays WHERE holiday_date = '$monday_date'";
            $result = mysqli_query($conn, $sql);
            $celebrated_id = '';
            while ($row = mysqli_fetch_object($result)) {
                $celebrated_id = $row->celebrated_id;
            }
            if ($monday_date === $holiday_date) {

                if ($celebrated_id == $nationality || $celebrated_id == $religion || $celebrated_id == 11) {

                    $foundDates[] = $monday_date;

                    $flag = true;

                    if ($monday_text == 'Втора') {
                        $holiday_monday_day = '6';
                        $holiday_monday_night = '1';
                        $monday_day = '0';
                        $monday_night = '0';
                    } elseif ($tuesday_text == 'Прва') {
                        $holiday_monday_day = '7';
                        $holiday_monday_night = '0';
                        $monday_day = '0';
                        $monday_night = '0';
                    } elseif ($monday_text == 'Меѓу') {
                        $holiday_monday_day = '5';
                        $holiday_monday_night = '0';
                        $monday_day = '0';
                        $monday_night = '0';
                    } else {
                        $holiday_monday_day = '0';
                        $holiday_monday_night = '0';
                        $monday_day = '0';
                        $monday_night = '0';
                    }
                    break;
                } else {

                    if ($monday_text == 'Втора') {
                        $holiday_monday_day = '0';
                        $holiday_monday_night = '0';
                        $monday_day = '6';
                        $monday_night = '1';
                    } elseif ($monday_text == 'Прва') {
                        $holiday_monday_day = '0';
                        $holiday_monday_night = '0';
                        $monday_day = '7';
                        $monday_night = '0';
                    } elseif ($monday_text == 'Меѓу') {
                        $holiday_monday_day = '0';
                        $holiday_monday_night = '0';
                        $monday_day = '5';
                        $monday_night = '0';
                    } else {
                        $holiday_monday_day = '0';
                        $holiday_monday_night = '0';
                        $monday_day = '0';
                        $monday_night = '0';
                    }
                    $flag = false;
                    break;
                }
            }

        } else {

            if ($monday_text == 'Втора') {
                $holiday_monday_day = '0';
                $holiday_monday_night = '0';
                $monday_day = '6';
                $monday_night = '1';
            } elseif ($monday_text == 'Прва') {
                $holiday_monday_day = '0';
                $holiday_monday_night = '0';
                $monday_day = '7';
                $monday_night = '0';
            } elseif ($monday_text == 'Меѓу') {
                $holiday_monday_day = '0';
                $holiday_monday_night = '0';
                $monday_day = '5';
                $monday_night = '0';
            } else {
                $holiday_monday_day = '0';
                $holiday_monday_night = '0';
                $monday_day = '0';
                $monday_night = '0';
            }
            $flag = false;
            break;
        }
        //return $flag;

    }


    $holiday_tuesday_day = '';
    $holiday_tuesday_night = '';
    $tuesday_day = '';
    $tuesday_night = '';

    foreach ($holiday_dates as $holiday_date) {
        if (in_array($tuesday_date, $holiday_dates)) {
            $sql = "SELECT celebrated_id FROM holidays WHERE holiday_date = '$tuesday_date'";
            $result = mysqli_query($conn, $sql);
            $celebrated_id = '';
            while ($row = mysqli_fetch_object($result)) {
                $celebrated_id = $row->celebrated_id;
            }
            if ($tuesday_date === $holiday_date) {

                if ($celebrated_id == $nationality || $celebrated_id == $religion || $celebrated_id == 11) {

                    $foundDates[] = $tuesday_date;

                    $flag = true;

                    if ($tuesday_text == 'Втора') {
                        $holiday_tuesday_day = '6';
                        $holiday_tuesday_night = '1';
                        $tuesday_day = '0';
                        $tuesday_night = '0';
                    } elseif ($tuesday_text == 'Прва') {
                        $holiday_tuesday_day = '7';
                        $holiday_tuesday_night = '0';
                        $tuesday_day = '0';
                        $tuesday_night = '0';
                    } elseif ($tuesday_text == 'Меѓу') {
                        $holiday_tuesday_day = '5';
                        $holiday_tuesday_night = '0';
                        $tuesday_day = '0';
                        $tuesday_night = '0';
                    } else {
                        $holiday_tuesday_day = '0';
                        $holiday_tuesday_night = '0';
                        $tuesday_day = '0';
                        $tuesday_night = '0';
                    }
                    break;
                } else {

                    if ($tuesday_text == 'Втора') {
                        $holiday_tuesday_day = '0';
                        $holiday_tuesday_night = '0';
                        $tuesday_day = '6';
                        $tuesday_night = '1';
                    } elseif ($tuesday_text == 'Прва') {
                        $holiday_tuesday_day = '0';
                        $holiday_tuesday_night = '0';
                        $tuesday_day = '7';
                        $tuesday_night = '0';
                    } elseif ($tuesday_text == 'Меѓу') {
                        $holiday_tuesday_day = '0';
                        $holiday_tuesday_night = '0';
                        $tuesday_day = '5';
                        $tuesday_night = '0';
                    } else {
                        $holiday_tuesday_day = '0';
                        $holiday_tuesday_night = '0';
                        $tuesday_day = '0';
                        $tuesday_night = '0';
                    }

                    $flag = false;
                    break;
                }
            }

        } else {

            if ($tuesday_text == 'Втора') {
                $holiday_tuesday_day = '0';
                $holiday_tuesday_night = '0';
                $tuesday_day = '6';
                $tuesday_night = '1';
            } elseif ($tuesday_text == 'Прва') {
                $holiday_tuesday_day = '0';
                $holiday_tuesday_night = '0';
                $tuesday_day = '7';
                $tuesday_night = '0';
            } elseif ($tuesday_text == 'Меѓу') {
                $holiday_tuesday_day = '0';
                $holiday_tuesday_night = '0';
                $tuesday_day = '5';
                $tuesday_night = '0';
            } else {
                $holiday_tuesday_day = '0';
                $holiday_tuesday_night = '0';
                $tuesday_day = '0';
                $tuesday_night = '0';
            }

            $flag = false;
            break;
        }
        //echo " vtornik";
        //return $flag;
    }

    $holiday_wednesday_day = '';
    $holiday_wednesday_night = '';
    $wednesday_day = '';
    $wednesday_night = '';
    foreach ($holiday_dates as $holiday_date) {
        if (in_array($wednesday_date, $holiday_dates)) {
            $sql = "SELECT celebrated_id FROM holidays WHERE holiday_date = '$wednesday_date'";
            $result = mysqli_query($conn, $sql);
            $celebrated_id = '';
            while ($row = mysqli_fetch_object($result)) {
                $celebrated_id = $row->celebrated_id;
            }
            if ($wednesday_date === $holiday_date) {

                if ($celebrated_id == $nationality || $celebrated_id == $religion || $celebrated_id == 11) {

                    $foundDates[] = $wednesday_date;

                    $flag = true;

                    if ($wednesday_text == 'Втора') {
                        $holiday_wednesday_day = '6';
                        $holiday_wednesday_night = '1';
                        $wednesday_day = '0';
                        $wednesday_night = '0';
                    } elseif ($wednesday_text == 'Прва') {
                        $holiday_wednesday_day = '7';
                        $holiday_wednesday_night = '0';
                        $wednesday_day = '0';
                        $wednesday_night = '0';
                    } elseif ($wednesday_text == 'Меѓу') {
                        $holiday_wednesday_day = '5';
                        $holiday_wednesday_night = '0';
                        $wednesday_day = '0';
                        $wednesday_night = '0';
                    } else {
                        $holiday_wednesday_day = '0';
                        $holiday_wednesday_night = '0';
                        $wednesday_day = '0';
                        $wednesday_night = '0';
                    }
                    break;
                } else {

                    if ($wednesday_text == 'Втора') {
                        $holiday_wednesday_day = '0';
                        $holiday_wednesday_night = '0';
                        $wednesday_day = '6';
                        $wednesday_night = '1';
                    } elseif ($wednesday_text == 'Прва') {
                        $holiday_wednesday_day = '0';
                        $holiday_wednesday_night = '0';
                        $wednesday_day = '7';
                        $wednesday_night = '0';
                    } elseif ($wednesday_text == 'Меѓу') {
                        $holiday_wednesday_day = '0';
                        $holiday_wednesday_night = '0';
                        $wednesday_day = '5';
                        $wednesday_night = '0';
                    } else {
                        $holiday_wednesday_day = '0';
                        $holiday_wednesday_night = '0';
                        $wednesday_day = '0';
                        $wednesday_night = '0';
                    }
                    $flag = false;
                    break;
                }
            }

        } else {

            if ($wednesday_text == 'Втора') {
                $holiday_wednesday_day = '0';
                $holiday_wednesday_night = '0';
                $wednesday_day = '6';
                $wednesday_night = '1';
            } elseif ($wednesday_text == 'Прва') {
                $holiday_wednesday_day = '0';
                $holiday_wednesday_night = '0';
                $wednesday_day = '7';
                $wednesday_night = '0';
            } elseif ($wednesday_text == 'Меѓу') {
                $holiday_wednesday_day = '0';
                $holiday_wednesday_night = '0';
                $wednesday_day = '5';
                $wednesday_night = '0';
            } else {
                $holiday_wednesday_day = '0';
                $holiday_wednesday_night = '0';
                $wednesday_day = '0';
                $wednesday_night = '0';
            }
            $flag = false;
            break;
        }
        //return $flag;
    }

    $holiday_thursday_day = '';
    $holiday_thursday_night = '';
    $thursday_day = '';
    $thursday_night = '';
    foreach ($holiday_dates as $holiday_date) {
        if (in_array($thursday_date, $holiday_dates)) {
            $sql = "SELECT celebrated_id FROM holidays WHERE holiday_date = '$thursday_date'";
            $result = mysqli_query($conn, $sql);
            $celebrated_id = '';
            while ($row = mysqli_fetch_object($result)) {
                $celebrated_id = $row->celebrated_id;
            }
            if ($thursday_date === $holiday_date) {

                if ($celebrated_id == $nationality || $celebrated_id == $religion || $celebrated_id == 11) {


                    $foundDates[] = $thursday_date;

                    $flag = true;

                    if ($thursday_text == 'Втора') {
                        $holiday_thursday_day = '6';
                        $holiday_thursday_night = '1';
                        $thursday_day = '0';
                        $thursday_night = '0';
                    } elseif ($thursday_text == 'Прва') {
                        $holiday_thursday_day = '7';
                        $holiday_thursday_night = '0';
                        $thursday_day = '0';
                        $thursday_night = '0';
                    } elseif ($thursday_text == 'Меѓу') {
                        $holiday_thursday_day = '5';
                        $holiday_thursday_night = '0';
                        $thursday_day = '0';
                        $thursday_night = '0';
                    } else {
                        $holiday_thursday_day = '0';
                        $holiday_thursday_night = '0';
                        $thursday_day = '0';
                        $thursday_night = '0';
                    }
                    break;
                } else {

                    if ($thursday_text == 'Втора') {
                        $holiday_thursday_day = '0';
                        $holiday_thursday_night = '0';
                        $thursday_day = '6';
                        $thursday_night = '1';
                    } elseif ($thursday_text == 'Прва') {
                        $holiday_thursday_day = '0';
                        $holiday_thursday_night = '0';
                        $thursday_day = '7';
                        $thursday_night = '0';
                    } elseif ($thursday_text == 'Меѓу') {
                        $holiday_thursday_day = '0';
                        $holiday_thursday_night = '0';
                        $thursday_day = '5';
                        $thursday_night = '0';
                    } else {
                        $holiday_thursday_day = '0';
                        $holiday_thursday_night = '0';
                        $thursday_day = '0';
                        $thursday_night = '0';
                    }
                    $flag = false;
                    break;
                }
                //return $flag;
            }


        } else {

            if ($thursday_text == 'Втора') {
                $holiday_thursday_day = '0';
                $holiday_thursday_night = '0';
                $thursday_day = '6';
                $thursday_night = '1';
            } elseif ($thursday_text == 'Прва') {
                $holiday_thursday_day = '0';
                $holiday_thursday_night = '0';
                $thursday_day = '7';
                $thursday_night = '0';
            } elseif ($thursday_text == 'Меѓу') {
                $holiday_thursday_day = '0';
                $holiday_thursday_night = '0';
                $thursday_day = '5';
                $thursday_night = '0';
            } else {
                $holiday_thursday_day = '0';
                $holiday_thursday_night = '0';
                $thursday_day = '0';
                $thursday_night = '0';
            }
            $flag = false;
            break;
        }
        //return $flag;
    }

    $holiday_friday_day = '';
    $holiday_friday_night = '';
    $friday_day = '';
    $friday_night = '';
    foreach ($holiday_dates as $holiday_date) {
        if (in_array($friday_date, $holiday_dates)) {
            $sql = "SELECT celebrated_id FROM holidays WHERE holiday_date = '$friday_date'";
            $result = mysqli_query($conn, $sql);
            $celebrated_id = '';
            while ($row = mysqli_fetch_object($result)) {
                $celebrated_id = $row->celebrated_id;
            }
            if ($friday_date === $holiday_date) {

                if ($celebrated_id == $nationality || $celebrated_id == $religion || $celebrated_id == 11) {

                    $foundDates[] = $friday_date;

                    $flag = true;

                    if ($friday_text == 'Втора') {
                        $holiday_friday_day = '6';
                        $holiday_friday_night = '1';
                        $friday_day = '0';
                        $friday_night = '0';
                    } elseif ($friday_text == 'Прва') {
                        $holiday_friday_day = '7';
                        $holiday_friday_night = '0';
                        $friday_day = '0';
                        $friday_night = '0';
                    } elseif ($friday_text == 'Меѓу') {
                        $holiday_friday_day = '5';
                        $holiday_friday_night = '0';
                        $friday_day = '0';
                        $friday_night = '0';
                    } else {
                        $holiday_friday_day = '0';
                        $holiday_friday_night = '0';
                        $friday_day = '0';
                        $friday_night = '0';
                    }
                    break;
                } else {

                    if ($friday_text == 'Втора') {
                        $holiday_friday_day = '0';
                        $holiday_friday_night = '0';
                        $friday_day = '6';
                        $friday_night = '1';
                    } elseif ($friday_text == 'Прва') {
                        $holiday_friday_day = '0';
                        $holiday_friday_night = '0';
                        $friday_day = '7';
                        $friday_night = '0';
                    } elseif ($friday_text == 'Меѓу') {
                        $holiday_friday_day = '0';
                        $holiday_friday_night = '0';
                        $friday_day = '5';
                        $friday_night = '0';
                    } else {
                        $holiday_friday_day = '0';
                        $holiday_friday_night = '0';
                        $friday_day = '0';
                        $friday_night = '0';
                    }
                    $flag = false;
                    break;
                }
            }
        } else {

            if ($friday_text == 'Втора') {
                $holiday_friday_day = '0';
                $holiday_friday_night = '0';
                $friday_day = '6';
                $friday_night = '1';
            } elseif ($friday_text == 'Прва') {
                $holiday_friday_day = '0';
                $holiday_friday_night = '0';
                $friday_day = '7';
                $friday_night = '0';
            } elseif ($friday_text == 'Меѓу') {
                $holiday_friday_day = '0';
                $holiday_friday_night = '0';
                $friday_day = '5';
                $friday_night = '0';
            } else {
                $holiday_friday_day = '0';
                $holiday_friday_night = '0';
                $friday_day = '0';
                $friday_night = '0';
            }
            $flag = false;
            break;
        }
        //return $flag;
    }

    $holiday_saturday_day = '';
    $holiday_saturday_night = '';
    $saturday_day = '';
    $saturday_night = '';
    foreach ($holiday_dates as $holiday_date) {
        if (in_array($saturday_date, $holiday_dates)) {
            $sql = "SELECT celebrated_id FROM holidays WHERE holiday_date = '$saturday_date'";
            $result = mysqli_query($conn, $sql);
            $celebrated_id = '';
            while ($row = mysqli_fetch_object($result)) {
                $celebrated_id = $row->celebrated_id;
            }
            if ($saturday_date === $holiday_date) {

                if ($celebrated_id == $nationality || $celebrated_id == $religion || $celebrated_id == 11) {

                    $foundDates[] = $saturday_date;

                    $flag = true;

                    if ($saturday_text == 'Втора') {
                        $holiday_saturday_day = '6';
                        $holiday_saturday_night = '1';
                        $saturday_day = '0';
                        $saturday_night = '0';
                    } elseif ($saturday_text == 'Прва') {
                        $holiday_saturday_day = '7';
                        $holiday_saturday_night = '0';
                        $saturday_day = '0';
                        $saturday_night = '0';
                    } elseif ($saturday_text == 'Меѓу') {
                        $holiday_saturday_day = '5';
                        $holiday_saturday_night = '0';
                        $saturday_day = '0';
                        $saturday_night = '0';
                    } else {
                        $holiday_saturday_day = '0';
                        $holiday_saturday_night = '0';
                        $saturday_day = '0';
                        $saturday_night = '0';
                    }
                    break;
                } else {

                    if ($saturday_text == 'Втора') {
                        $holiday_saturday_day = '0';
                        $holiday_saturday_night = '0';
                        $saturday_day = '6';
                        $saturday_night = '1';
                    } elseif ($saturday_text == 'Прва') {
                        $holiday_saturday_day = '0';
                        $holiday_saturday_night = '0';
                        $saturday_day = '7';
                        $saturday_night = '0';
                    } elseif ($saturday_text == 'Меѓу') {
                        $holiday_saturday_day = '0';
                        $holiday_saturday_night = '0';
                        $saturday_day = '5';
                        $saturday_night = '0';
                    } else {
                        $holiday_saturday_day = '0';
                        $holiday_saturday_night = '0';
                        $saturday_day = '0';
                        $saturday_night = '0';
                    }
                    $flag = false;
                    break;
                }
            }
        } else {

            if ($saturday_text == 'Втора') {
                $holiday_saturday_day = '0';
                $holiday_saturday_night = '0';
                $saturday_day = '6';
                $saturday_night = '1';
            } elseif ($saturday_text == 'Прва') {
                $holiday_saturday_day = '0';
                $holiday_saturday_night = '0';
                $saturday_day = '7';
                $saturday_night = '0';
            } elseif ($saturday_text == 'Меѓу') {
                $holiday_saturday_day = '0';
                $holiday_saturday_night = '0';
                $saturday_day = '5';
                $saturday_night = '0';
            } else {
                $holiday_saturday_day = '0';
                $holiday_saturday_night = '0';
                $saturday_day = '0';
                $saturday_night = '0';
            }
            $flag = false;
            break;
        }
        //return $flag;
    }

    $holiday_sunday_day = '';
    $holiday_sunday_night = '';
    $sunday_day = '';
    $sunday_night = '';
    foreach ($holiday_dates as $holiday_date) {
        if (in_array($sunday_date, $holiday_dates)) {
            $sql = "SELECT celebrated_id FROM holidays WHERE holiday_date = '$sunday_date'";
            $result = mysqli_query($conn, $sql);
            $celebrated_id = '';
            while ($row = mysqli_fetch_object($result)) {
                $celebrated_id = $row->celebrated_id;
            }
            if ($sunday_date === $holiday_date) {

                if ($celebrated_id == $nationality || $celebrated_id == $religion || $celebrated_id == 11) {

                    $foundDates[] = $sunday_date;

                    $flag = true;

                    if ($sunday_text == 'Втора') {
                        $holiday_sunday_day = '6';
                        $holiday_sunday_night = '1';
                        $sunday_day = '0';
                        $sunday_night = '0';
                    } elseif ($sunday_text == 'Прва') {
                        $holiday_sunday_day = '7';
                        $holiday_sunday_night = '0';
                        $sunday_day = '0';
                        $sunday_night = '0';
                    } elseif ($sunday_text == 'Меѓу') {
                        $holiday_sunday_day = '5';
                        $holiday_sunday_night = '0';
                        $sunday_day = '0';
                        $sunday_night = '0';
                    } else {
                        $holiday_sunday_day = '0';
                        $holiday_sunday_night = '0';
                        $sunday_day = '0';
                        $sunday_night = '0';
                    }
                    break;
                } else {

                    if ($sunday_text == 'Втора') {
                        $holiday_sunday_day = '0';
                        $holiday_sunday_night = '0';
                        $sunday_day = '6';
                        $sunday_night = '1';
                    } elseif ($sunday_text == 'Прва') {
                        $holiday_sunday_day = '0';
                        $holiday_sunday_night = '0';
                        $sunday_day = '7';
                        $sunday_night = '0';
                    } elseif ($sunday_text == 'Меѓу') {
                        $holiday_sunday_day = '0';
                        $holiday_sunday_night = '0';
                        $sunday_day = '5';
                        $sunday_night = '0';
                    } else {
                        $holiday_sunday_day = '0';
                        $holiday_sunday_night = '0';
                        $sunday_day = '0';
                        $sunday_night = '0';
                    }
                    $flag = false;
                    break;
                }
            }
        } else {

            if ($sunday_text == 'Втора') {
                $holiday_sunday_day = '0';
                $holiday_sunday_night = '0';
                $sunday_day = '6';
                $sunday_night = '1';
            } elseif ($sunday_text == 'Прва') {
                $holiday_sunday_day = '0';
                $holiday_sunday_night = '0';
                $sunday_day = '7';
                $sunday_night = '0';
            } elseif ($sunday_text == 'Меѓу') {
                $holiday_sunday_day = '0';
                $holiday_sunday_night = '0';
                $sunday_day = '5';
                $sunday_night = '0';
            } else {
                $holiday_sunday_day = '0';
                $holiday_sunday_night = '0';
                $sunday_day = '0';
                $sunday_night = '0';
            }
            $flag = false;
            break;
        }
        //return $flag;
    }

    $column_value[$i] = " '$employees', '$city_id', '$region_id', '$monday_text', '$monday_day', '$monday_night', '$holiday_monday_day', '$holiday_monday_night', '$monday_date' : '$employees', '$city_id', '$region_id', '$tuesday_text', '$tuesday_day', '$tuesday_night', '$holiday_tuesday_day', '$holiday_tuesday_night', '$tuesday_date' : '$employees', '$city_id', '$region_id', '$wednesday_text', '$wednesday_day', '$wednesday_night', '$holiday_wednesday_day', '$holiday_wednesday_night', '$wednesday_date' : '$employees', '$city_id', '$region_id', '$thursday_text', '$thursday_day', '$thursday_night', '$holiday_thursday_day', '$holiday_thursday_night', '$thursday_date' : '$employees', '$city_id', '$region_id', '$friday_text', '$friday_day', '$friday_night', '$holiday_friday_day', '$holiday_friday_night', '$friday_date' : '$employees', '$city_id', '$region_id', '$saturday_text', '$saturday_day', '$saturday_night', '$holiday_saturday_day', '$holiday_saturday_night', '$saturday_date' : '$employees', '$city_id', '$region_id', '$sunday_text', '$sunday_day', '$sunday_night', '$holiday_sunday_day', '$holiday_sunday_night', '$sunday_date' ";

    $value = $column_value[$i];


    $first_value = preg_split('[:]', $value)[0];
    $second_value = preg_split('[:]', $value)[1];
    $third_value = preg_split('[:]', $value)[2];
    $fourth_value = preg_split('[:]', $value)[3];
    $fifth_value = preg_split('[:]', $value)[4];
    $sixth_value = preg_split('[:]', $value)[5];
    $seventh_value = preg_split('[:]', $value)[6];


    $object->insert($table_name, $column_name, $first_value);
    $object->insert($table_name, $column_name, $second_value);
    $object->insert($table_name, $column_name, $third_value);
    $object->insert($table_name, $column_name, $fourth_value);
    $object->insert($table_name, $column_name, $fifth_value);
    $object->insert($table_name, $column_name, $sixth_value);
    $object->insert($table_name, $column_name, $seventh_value);


}


header('Location:index.php');

exit();