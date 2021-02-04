<?php include('server.php') ?>
<?php
$id = $_GET['id'];
echo $id;
$del = "DELETE from employee WHERE id=$id";
mysqli_query($db,$del);
header("location:index.php");
?>