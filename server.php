<?php

session_start();
// $_SESSION["operation"]="add";
// initializing variables for register page
$username = "";
$email    = "";
$id = 0;
//  initializing variables for employee page
$firstname = "";
$lastname = "";
$department = "";
$address = "";
// for error
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', 'webkul', 'registration');





// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT id FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_num_rows($result);

 
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
}
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
// for employees
if (isset($_POST['saveemployee'])) {
    // receive all input values from the form
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $department = mysqli_real_escape_string($db, $_POST['department']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $status = $_POST['status'];
   
  //  echo $firstname;
  //  echo $lastname;
  //  echo $department;
  //  echo $address;
  //  echo $gender;
  //  echo $status;

  //  echo $_SESSION['operation'];

   if($_SESSION['operation']=="edit"){ $addemployee="UPDATE employee set firstname='" . $firstname . "', lastname='" . $lastname. "', department='". $department."', address='" . $address . "', gender= '" . $gender . "', status='" . $status ."' WHERE id='" . $_SESSION['userid'] . "'";
  //  echo $addemployee;
    mysqli_query($db, $addemployee);
    $_SESSION['operation']="add";}else{$addemployee= "INSERT INTO employee (firstname, lastname, department, address, gender, status, loginuser) 
    VALUES('$firstname', '$lastname', '$department', '$address', '$gender', '$status'   ,'".$_SESSION['username']."')";
mysqli_query($db, $addemployee);} 
// $_SESSION["operation"]="add";

$_SESSION["status"]="";
$_SESSION["firstname"]="";
$_SESSION["lastname"]="";
$_SESSION["address"]="";
$_SESSION["department"]="";
$_SESSION["gender"]="";
$_SESSION["userid"]="";



//     $addemployee = "INSERT INTO employee (firstname, lastname, department, address, gender, status, loginuser) 
//     VALUES('$firstname', '$lastname', '$department', '$address', '$gender', '$status'   ,'".$_SESSION['username']."')";
// mysqli_query($db, $addemployee);
//     header('location: index.php');  

// }
// if(isset($_POST['editemployee'])){
//   //  echo "session".$_SESSION['id'];
//     $firstname =  $_POST['firstname'];
//     $lastname =  $_POST['lastname'];
//      $department =  $_POST['department'];
//      $address =  $_POST['address'];
//      $gender =  $_POST['gender'];
//      $status =  $_POST['status'];
//      $id =  $_POST['id'];

//      $sql = "UPDATE employee set firstname='" . $_POST['firstname'] . "', lastname='" . $_POST['lastname'] . "', department='". $_POST['department']."', address='" . $_POST['address'] . "', gender= '" . $_POST['gender'] . "', status='" . $_POST['status'] ."' WHERE id='" . $_POST['id'] . "'";
//      $result=mysqli_query($db, $sql);



   

  unset($_SESSION['operation']);
  

}
