<?php include('server.php') ?>
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
	<a class="btn btn-primary" href="data.php" role="button" >Add</a>
	<!-- <button type="button" class="btn btn-danger">Danger</button> -->
	<!-- <a class="btn btn-primary" href="edit.php" role="button" onclick="editemployee()">Edit</a> -->
</div>

<body>


<!-- <button class="open-button" onclick="addemployee()">Open Form</button> -->

<!-- <div class="form-popup" id="myForm">
  <form action="index.php" class="form-container" method="post">
    <h1>Empoyee details:</h1>

    <label for="status">Choose a status:</label>
  <select name="status">
    <option value="enable">Enable</option>
    <option value="disable">Disable</option>
  </select><br><br>

    <label for="First Name"><b>First Name</b></label>
    <input type="text" placeholder="First Name" name="firstname" value=""required>

    <label for="Last Name"><b>Last Name</b></label>
	<input type="text" placeholder="Last Name" name="lastname" value=""required>
	
  <p><label for="Department"><b>Please select Department:</b></label></p>
  <input type="checkbox" id="vehicle1" name="department" value="opencart">
  <label for="Opencart"> Opencart</label><br>
  <input type="checkbox" id="vehicle2" name="department" value="mgento" >
  <label for="Mgento"> Mgento</label><br>
  <input type="checkbox" id="vehicle3" name="department" value="sopify" >
  <label for="sopify"> Sopify</label><br><br> 
	<!-- <input type="text" placeholder="Department" name="department" value=""required> -->
	
	<!-- <label for="Address"><b>Address</b></label> -->
    <!-- <input type="text" placeholder="Address" name="address" value=""required> -->

    <!-- <p><b>Please select your gender:</b></p>
  <input type="radio" id="male" name="gender" value="male">
  <label for="male">Male</label><br>
  <input type="radio" id="female" name="gender" value="female">
  <label for="female">Female</label><br>
  <input type="radio" id="other" name="gender" value="other">
  <label for="other">Other</label> -->
  
   <!-- <tr>  
      <td colspan="2">Select Technolgy:</td>  
   </tr>  
   <tr>  
      <td>PHP</td>  
      <td><input type="checkbox" name="techno[]" value="PHP"></td>  
   </tr>  
   <tr>  
      <td>.Net</td>  
      <td><input type="checkbox" name="techno[]" value=".Net"></td>  
   </tr>  
   <tr>  
      <td>Java</td>  
      <td><input type="checkbox" name="techno[]" value="Java"></td>  
   </tr>  
   <tr>  
      <td>Javascript</td>  
      <td><input type="checkbox" name="techno[]" value="javascript"></td>  
   </tr>  
    -->
<!-- </table>  

    <button type="save" class="btn" name="saveemployee">Save</button>
    <button type="button" class="btn cancel" onclick="addcloseForm()">Close</button>
  </form>
</div> --> 



		<div class="table-responsive">
					<table class="table text-center ">
						<thead>
							<tr>
							
                <!-- <td>id</td> -->
                <td><b>Status</b></td>
								<td><b>First Name</b></td>
								<td><b>Last Name</b></td>
								<td><b>Department</b></td>
                <td><b>Address</b></td>
                <td><b>Gender</b></td>
								<td><b>Action</b></td>
													
							</tr>
						</thead>
						<?php
                $fetchquery = "SELECT * FROM employee where loginuser='".$_SESSION['username']."'";
              // echo  $fetchquery;
                $result = mysqli_query($db, $fetchquery);
                // echo $result;
                $count = mysqli_num_rows($result);
                // echo $count;
								if ($count > 0) {
									foreach ($result as $row) {
                    
										echo'
									<tr>
										
                  <td hidden><span id="id_'.$row["id"].'">' . $row["id"] . '</span></td>
                    <td><span id="status_'.$row["id"].'">' . $row["status"] . '</span></td>
										<td><span id="firstname_'.$row["id"].'">' . $row["firstname"] . '</span></td>
										<td><span id="lastname_'.$row["id"].'">' . $row["lastname"] . '</span></td>
										<td><span id="department_'.$row["id"].'">' . $row["department"] . '</span></td>
                    <td><span id="address_'.$row["id"].'">' . $row["address"]  . '</span></td>
                    <td><span id="gender_'.$row["id"].'">' . $row["gender"]  . '</span></td>
										
										
                     <td>' . '<a href="delete.php?id='.$row["id"].'"><button>Delete</button></a>&nbsp&nbsp<a onClick="editemployee('.$row['id'].')" ><button>Edit</button></a>' . '</td>
									
                          
										
										
									</tr>';
									}
								}

						?>
					</table>
			</div>
			
		
      <!-- onClick="editemployee('.$row['id'].')" -->

 <!-- <div class="form-popup" id="editForm">
  <form action="index.php" class="form-container" method="post">
    <h1>Edit employee details:</h1>

    <label for="status">Choose a status:</label>
  <select name="status" id="status_editForm">
    <option value="enable">Enable</option>
    <option value="disable">Disable</option>
  </select><br><br>

    <label for="First Name"><b>First Name</b></label>
    <input type="text" placeholder="First Name" name="firstname" id="firstname_editForm" required>

    <label for="Last Name"><b>Last Name</b></label>
	<input type="text" placeholder="Last Name" name="lastname" id="lastname_editForm" required>
	 -->
	<!-- <label for="Department"><b>Department</b></label>
	<input type="text" placeholder="Department" name="department" id="department_editForm" required> 
   <label style="display:none" ></label>id  -->
  <!-- <div id="department_editForm">
  <p><b>Please select Department:</b></p>
  <input type="checkbox" id="vehicle1" name="department" value="opencart">
  <label for="Opencart"> Opencart</label><br>
  <input type="checkbox" id="vehicle2" name="department" value="mgento" >
  <label for="Mgento"> Mgento</label><br>
  <input type="checkbox" id="vehicle3" name="department" value="sopify" >
  <label for="sopify"> Sopify</label><br><br>
  </div> -->

	<!-- <label for="Address"><b>Address</b></label>
    <input type="text" placeholder="Address" name="address" id="address_editForm" required>
    <input type="text" name="id" style="display:none" id="id_editform" required> -->

    <!-- <p><b>Please select your gender:</b></p>
  <input type="radio" id="male" name="gender" id=gender_editForm value="male"  >
  <label for="male">Male</label><br>
  <input type="radio" id="female" name="gender" id=gender_editForm value="female">
  <label for="female">Female</label><br>
  <input type="radio" id="other" name="gender" id=gender_editForm value="other">
  <label for="other">Other</label> -->

    <!-- <button type="edit" class="btn" name="editemployee">Update</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>  -->
				 

 <!-- <script type="text/javascript" src="jquery-1.3.2.js"> </script> -->

<script type="text/javascript">

        function editemployee(userIid){
          // alert("hello");
            // Selecting the input element and get its value 
            var inputVal1 = document.getElementById("status_"+userIid).innerText;
            var inputVal2 = document.getElementById("firstname_"+userIid).innerText;
            var inputVal3 = document.getElementById("lastname_"+userIid).innerText;
            var inputVal4 = document.getElementById("department_"+userIid).innerText;
            var inputVal5 = document.getElementById("address_"+userIid).innerText;
            var inputVal6 = document.getElementById("gender_"+userIid).innerText;
            // Displaying the value
    //         $.ajax({ url: 'http://192.168.15.28/Register/test.php',
    //      data: {
    //          'status' : inputVal1,
    //          'firstname' : inputVal2,
    //          'lastname' : inputVal3,
    //          'department' : inputVal4,
    //          'address' : inputVal5,
    //          'gender' : inputVal6,
             
    //      },
    //      type: 'post',
    //      dataType:'json',
         
    //      success: function(data) {
    //       console.log("ts");
    //      }
    // });
    $.ajax({
        url: 'test.php',
        type: 'POST',

        data:'operation=edit&status='+inputVal1+'&firstname='+inputVal2+'&lastname='+inputVal3+'&department='+inputVal4+'&address='+inputVal5+'&gender='+inputVal6+'&id='+userIid,

        success: function(result) {
            // $('#results,#errors').remove();
            // $('#contactWrapper').append('<p id="results">' + result + '</p>');
            // $('#loading').fadeOut(500, function() {
            //     $(this).remove();
          location.href  = "data.php" ; 

        }
            });

        }
        

        
    </script> 





  


	

		


		

</body>

</html>

