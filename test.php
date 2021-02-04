<?php include('server.php') ?>
<?php 
$_SESSION["operation"]=$_POST["operation"];
// echo $_POST["operation"];
$_SESSION["status"]=$_POST["status"];
$_SESSION["firstname"]=$_POST["firstname"];
$_SESSION["lastname"]=$_POST["lastname"];
$_SESSION["address"]=$_POST["address"];
$_SESSION["department"]=$_POST["department"];
$_SESSION["gender"]=$_POST["gender"];
$_SESSION["userid"]=$_POST["id"];



?>