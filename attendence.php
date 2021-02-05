
<?php include('server.php') ?>
<?php 
// echo("ritesh");
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
	.header1 {
    width: 94%;
    margin: 50px auto 0px;
    color: white;
    background: #5F9EA0;
    text-align: center;
    border: 1px solid #0a0f16;
    border-bottom: none;
    border-radius: 10px 10px 0px 0px;
    padding: 20px;
	}

	orm, .content {
    width: 94%;
    margin: 0px auto;
    padding: 20px;
    border: 1px solid #B0C4DE;
    background: white;
    border-radius: 0px 0px 10px 10px;
}
#welcome {
float: right;
}

body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */

.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

.form-container {
    max-width: 575px;
    padding: 10px;
    background-color: white;
}
form, .content {
	width: 94%;
    margin: 0px auto;
    padding: 20px;
    border: 1px solid #B0C4DE;
    background: white;
    border-radius: 0px 0px 10px 10px;
}




</style>
</head>
<body>

<div class="header1">
	<h2>Welcome</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p id="welcome">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p><br>
    	<p id="welcome"> <a href="index.php?logout='1'" style="color: red;"><button>logout</button></a> </p>
	<?php endif ?>
	

<form method="post" action="check.php">
<label>Choose for attendence</label>
<select id="drop" name="dropdown">
    
  <?php
   $cdquery = "SELECT * FROM employee where loginuser='".$_SESSION['username']."'";
            
            $cdresult=mysqli_query($db,$cdquery);
            
            while ($cdrow=mysqli_fetch_array($cdresult)) {
            $cdTitle=$cdrow["firstname"];
                echo "<option>$cdTitle </option>";
            
            }
  ?>
</select><br><br>

<label for="Select Date">Select Date:</label>
  <input type="date" id="input-date" name="date" ><br><br>
 
  
  <button class="btn" type="submit" name="sub_emp" value="data" >Save</button>
  
        
       
</form>

</html


        

