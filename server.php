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
    // $department = mysqli_real_escape_string($db, $_POST['department[]']);
   
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $status = $_POST['status'];
    $checkbox1=$_POST['department'];  
    $chk="";  
    foreach($checkbox1 as $chk1)  
       {  
          $chk .= $chk1.",";  
       }  
   


    $addemployee = "INSERT INTO employee (firstname, lastname, department, address, gender, status, loginuser) 
    VALUES('$firstname', '$lastname', '$chk', '$address', '$gender', '$status'   ,'".$_SESSION['username']."')";
    mysqli_query($db, $addemployee);
    header('location: index.php');
  

}
if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$status = $_POST['status'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $department = $_POST['department'];
  $address = $_POST['address'];
  $gender = $_POST['gender'];
  


	mysqli_query($db, "UPDATE employee SET status='$status', firstname='$firstname' , lastname='$lastname' , department='$department'
                        , address='$address' , gender='$gender' WHERE id=$id");
	$_SESSION['message'] = "Address updated!"; 
	header('location: index.php');
}

if (isset($_POST['sub_emp'])) {
  
   $dropdown = $_POST['dropdown'];
  $date = $_POST['date'];

  $sql = "INSERT INTO attendence (emp_name, date) VALUES ('$dropdown', '$date')";
  mysqli_query($db, $sql);

  
  
}
