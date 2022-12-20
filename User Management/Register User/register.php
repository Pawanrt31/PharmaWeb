<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');

// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password_1')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: home.php');
  }
}
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  

  if (count($errors) == 0) {
  	//$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: home.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>User registration</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript">
function myfunc()
{
var id1= document.getElementsByName("username");
var id2= document.getElementsByName("email");
var id3= document.getElementsByName("password_1");
var id4= document.getElementsByName("password_2");
if(id1[0].value.length==0&&id2[0].value.length==0&&id3[0].value.length==0&&id4[0].value.length==0)
{
 alert(	"Please enter all the details");
 id1.focus();
 return false;
}
if(
if(id3[0].value!=id4[0].value)
{
	alert("Password's do not match");
	return false;
}
else
	return true;
}
</script>
</head>
<body style="background-image:url(medical4.jpg);background-repeat:no-repeat;background-position:center;background-size:cover">
<div class="header">
  <h2>Register</h2>
 </div>
 <form method="post" action="register.php" onSubmit="myfunc()">
 
 <div class="input-group">
  <label>Username</label>
  <input type="text" name="username">
  </div>
  <div class="input-group">
  <label>Email</label>
  <input type="text" name="email">
  </div>
  <div class="input-group">
  <label>Password</label>
  <input type="password" name="password_1">
  </div>
  <div class="input-group">
  <label>Confirm password</label>
  <input type="password" name="password_2">
  </div>
  <div class="input-group">
  <button type="submit" name="register" class="btn">Register</button>
  </div>
  <p>
  Already a member?<a href="login.php">Log in</a>
  </form>
 </body>
 </html>