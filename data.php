<?php include('server.php') ?>
<?php 
	if (isset($_GET['id'])) {
        $id = $_GET['id'];
		$update = true;
        $record = mysqli_query($db, "SELECT * FROM employee WHERE id=$id");
        // echo $record;
      
		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
            $status = $n['status'];
            $firstname = $n['firstname'];
            $lastname = $n['lastname'];
            $department = $n['department'];

            $dep = explode(',', $department);

            // print_r($dep);exit;     
                   $address = $n['address'];
            $gender = $n['gender'];
		}
	}
?>
<?php 
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
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
    display: none;
    position: absolute;
    bottom: 0;
    right: 584px;
    border: 3px solid #f1f1f1;
    z-index: 9;
}

/* Add styles to the form container */
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
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

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
</div>

<body>





  <form action="index.php" class="form-container" method="post"  id="editForm">
    <h1>Empoyee details:</h1>

    <label for="status">Choose a status:</label>
  <select name="status" id="drop" >
    <option value="enable"  <?php if($status =="enable"){echo "selected";}?>>Enable</option>
    <option value="disable"  <?php if($status =="disable"){echo "selected";}?> >Disable</option>
  </select><br><br>

    <label for="First Name"><b>First Name</b></label>
    <input type="text" placeholder="First Name" name="firstname"  value="<?php echo $firstname; ?>" required>
 

    <label for="Last Name"><b>Last Name</b></label>
	<input type="text" placeholder="Last Name" name="lastname" value="<?php echo $lastname; ?>" required>
	
  <p><label for="Department"><b>Please select Department:</b></label></p>
  
  <input type="checkbox" id="department1" name="department[]"  value="opencart" <?php if(in_array('opencart',$dep)){echo "checked";}?> >
  <label for="department1"> Opencart</label><br>
  <input type="checkbox" id="department2" name="department[]" value="mgento" <?php if(in_array('mgento',$dep)){echo "checked";}?> >
  <label for="department2"> Mgento</label><br>
  <input type="checkbox" id="department3" name="department[]" value="sopify" <?php if(in_array('sopify',$dep)){echo "checked";}?> >
  <label for="department3"> Sopify</label><br><br> 


	
	
	<label for="Address"><b>Address</b></label>
    <input type="text" placeholder="Address" name="address" id="address_editForm" value="<?php echo $address; ?>"required>

    <p><b>Please select your gender:</b></p>
  <input type="radio" id="male" name="gender" value="male" <?php if($gender == "male"){echo "checked";}?>>
  <label for="male">Male</label><br>
  <input type="radio" id="female" name="gender" value="female" <?php if($gender=="female"){echo "checked";}?>>
  <label for="female">Female</label><br>
  <input type="radio" id="other" name="gender" value="other" <?php if($gender =="other"){echo "checked";}?>>
  <label for="other">Other</label>
  
  <input type="hidden" name="id" value="<?php echo $id; ?>">

    <!-- <button type="save" class="btn" name="saveemployee">Save</button> -->
    <?php if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
    <?php else: ?>
        <button class="btn" type="submit" name="saveemployee" >Save</button>
    <?php endif ?>
  
  </form>
</div> 
<script>
    // $("#drop").val("val2");
</script>




		

    </body>
</html>


<!-- <span hidden id="operation">php echo $_SESSION['operation'] </span> -->