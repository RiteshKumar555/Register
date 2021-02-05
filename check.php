<?php
$db = mysqli_connect('localhost', 'root', 'webkul', 'registration');

$edate =  $_REQUEST['date'];
$ename =  $_REQUEST['dropdown'];

$query = "SELECT id FROM attendence WHERE emp_name = '$ename' AND date ='$edate' ";
$result = mysqli_query($db, $query);
$count = mysqli_num_rows($result);



if ($count == 0) {
    $sql = "INSERT INTO attendence (emp_name, date) VALUES ('$ename', '$edate')";
    $res =  mysqli_query($db, $sql);
    $cou = mysqli_num_rows($db);
    if ($cou == 1) {
?>


        <script>
            alert("something is wrong with you please check  !!");

            setTimeout(function() {
                window.location.replace("attendence.php");
            }, 1000);
        </script>

    <?php
    } else {
    ?>
        <script>
            alert("attendence successfully marked!");

            setTimeout(function() {
                window.location.replace("attendence.php");
            }, 0);
        </script>

    <?php
    }
} else {
    ?>


    <script>
        alert("your today attendence ALREDY marked");

        setTimeout(function() {
            window.location.replace("attendence.php");
        }, 1000);
    </script>

<?php
}


?>