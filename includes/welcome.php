<?php
session_start();
?>
<?php include '../includes/header.php'; ?>
<nav class="navbar navbar-expand-lg" style="background-color: #333333;">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php

            if ($_SESSION['position_id'] == '3') {

                echo "    
            <li class='nav-item'>
                <a class='nav-link text-white' href='../admins/index.php'>Admins</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link text-white' href='../managers/index.php'>Managers</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link text-white' href='../bosses/index.php'>Bosses</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link text-white' href='../employees/index.php'>Employee</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link text-white' href='../schedule/index.php'>Schedules</a>
            </li>

            <li class='nav-item'>
                <a class='nav-link text-white' href='../location/index.php'>Locations</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link text-white' href='../regions/index.php'>Regions</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link text-white' href='../schedule/final.php'>Final schedules</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link text-white' href='../file/index.php'>Create file</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link text-white' href='../holidays/index.php'>Holidays</a>
            </li>
            <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle text-white' href='#' id='navbarDropdownMenuLink' data-toggle='dropdown'
                   aria-haspopup='true' aria-expanded='false'>
        NEW
                </a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                    <a class='dropdown-item' href='../admins/insert.php'>New admin</a>
                    <a class='dropdown-item' href='../managers/insert.php'>New manager</a>
                    <a class='dropdown-item' href='../bosses/insert.php'>New boss</a>
                    <a class='dropdown-item' href='../employees/insert.php'>New employee</a>
                    <a class='dropdown-item' href='../schedule/insert.php'>New schedule</a>
                    <a class='dropdown-item' href='../location/insert.php'>New location</a>
                    <a class='dropdown-item' href='../regions/insert.php'>New region</a>
                    <a class='dropdown-item' href='../holidays/insert.php'>New holiday</a>
                </div>
            </li>
";
            } elseif ($_SESSION['position_id'] == '4') {

                echo "
            <li class='nav-item'>
                <a class='nav-link text-white' href='../bosses/index.php'>Bosses</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link text-white' href='../employees/index.php'>Employees</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link text-white' href='../schedule/index.php'>Schedules</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link text-white' href='../schedule/final.php'>Final schedules</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link text-white' href='../file/index.php'>Create file</a>
            </li>
            <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle text-white' href='#' id='navbarDropdownMenuLink' data-toggle='dropdown'
                   aria-haspopup='true' aria-expanded='false'>
        NEW
                </a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                    <a class='dropdown-item' href='../bosses/insert.php'>New boss</a>
                    <a class='dropdown-item' href='../employees/insert.php'>New employee</a>
                    <a class='dropdown-item' href='../schedule/insert.php'>New schedule</a>
                </div>
            </li>
    
    ";
            } elseif ($_SESSION['position_id'] == '1') {

                echo "
            
            <li class='nav-item'>
                <a class='nav-link text-white' href='../schedule/index.php'>Schedules</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link text-white' href='../schedule/insert.php'>New schedule</a>
            </li>
            
    ";

            }

            ?>

            <li class="nav-item">
                <a class="nav-link text-white" href="../logout.php">Logout</a>
            </li>
        </ul>
        <h5 class="pull-right nav-item text-white"><?= $_SESSION['username'] ?></h5>
    </div>
</nav>

<div class="welcome-name">
    <?php
    if ($_SESSION['position_id'] == '3') {
        $upper = strtoupper($_SESSION['username']);
        echo "<h1 class='text-center text-white'>Welcome admin $upper</h1>";
    } elseif ($_SESSION['position_id'] == '4') {
        $upper = strtoupper($_SESSION['username']);
        echo "<h1 class='text-center text-white'>Welcome manager $upper</h1>";
    } elseif ($_SESSION['position_id'] == '1') {
        $upper = strtoupper($_SESSION['username']);
        echo "<h1 class='text-center text-white'>Welcome boss $upper</h1>";
    }

    ?>
</div>
</div>
</div>
<div class="container-fluid">

    <footer class="text-center text-footer text-white">
        <hr>
        Copyright &copy; 2018
    </footer>

</div>

</body>

</html>
