<?php require_once '../includes/db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:../index.php');
}

?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>
<script>

    function showRegion(str) {
        if (str == "") {
            document.getElementById("selected").innerHTML = "";
            return;
        } else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("selected").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "selectedRegion.php?region_id=" + str, true);
            xmlhttp.send();
        }
    }

</script>

<?php

//$value = isset($_GET['region_id']) ? $_GET['region_id'] : '';

?>

<div>
    <br>
    <h3 class="text-center font-weight-bold text-white">Locations</h3><br>
    <?php if ($_SESSION['position_id'] == '3'){ ?>
    <form action="" method="post">
        <span style="color: white;">Filter by region: </span>
        <select name="selected" id="region" onchange="showRegion(this.value)">
            <option name="region_id" id="region_id">Select region</option>
            <option name="region_id" id="region_id" value="0">All</option>

            <?php

            $sql3 = "SELECT * FROM regions WHERE region_id>1";

            $result3 = $conn->query($sql3);
            while ($row3 = $result3->fetch_object()) {
                $region_id = $row3->region_id;
                $region = $row3->region;

                echo "<option name='region_id' id='region_id' value='$region_id'>$region</option>";
            }

            ?>
        </select>

        <div id="selected"></div>


    </form>
</div>
<?php } else {
    echo "<h1 class='text-center font-weight-bold'>You are not allowed to see this section.</h1>";
} ?>
<?php include '../includes/footer.php'; ?>
