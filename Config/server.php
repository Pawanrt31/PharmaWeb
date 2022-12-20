//Code to connect to the database
<?php
session_start();
// initializing variables
$username = "";
$email    = "";
 // connect to the database
$db = mysqli_connect('localhost', 'root', '', 'login1');
//login to the system
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $query = "SELECT * FROM det WHERE user='$username' AND pass='$password'";
 	$results = mysqli_query($db, $query);
  if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: home.php');
  	}
}
?>
