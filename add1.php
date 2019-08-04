<?php 
session_start();

// initializing variables
$medcode = 0;
$medname = "";
$composition = "";
$mandate = "";
$expdate = "";
$mandate1 = "";
$expdate1 = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');
// REGISTER USER
if (isset($_POST['add'])) {
  // receive all input values from the form
  $medcode = mysqli_real_escape_string($db, $_POST['medcode']);
  $medname = mysqli_real_escape_string($db, $_POST['medname']);
  $composition = mysqli_real_escape_string($db, $_POST['composition']);
  $mandate = mysqli_real_escape_string($db, $_POST['mandate']);
  $expdate = mysqli_real_escape_string($db, $_POST['expdate']);
  //$mandate1=mysql($mandate);
  //$expdate1=strrev($expdate);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($medcode)) { array_push($errors, "Medicine code is required"); }
  if (empty($medname)) { array_push($errors, "Medicine name is required"); }
  if (empty($composition)) { array_push($errors, "Composition is required"); }
  if (empty($mandate)) { array_push($errors, "Manufacture date is required"); }
  if (empty($expdate)) { array_push($errors, "Expiry date is required"); }
  

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM medicine WHERE med_code='$medcode' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $medicine = mysqli_fetch_assoc($result);
  
  if ($medicine) { // if user exists
    if ($medicine['med_code'] === $medcode) {
      array_push($errors, "Medicine already exists");
    }

    //if ($user['email'] === $email) {
     // array_push($errors, "email already exists");
    //}
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password_1);//encrypt the password before saving in the database
    //$mandate1 = strrev($mandate);
	//$expdate1 = strrev($expdat
  	$query = "INSERT INTO medicine (med_code, med_name, composition, manufacture, expiry) 
  			  VALUES('$medcode', '$medname', '$composition','$mandate','$expdate')";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "Successfully added a medicine";
  	header('location: home.php');
  }
}
?>