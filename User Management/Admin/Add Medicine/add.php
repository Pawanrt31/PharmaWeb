//Code to add a medicine
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
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$query = "INSERT INTO medicine (med_code, med_name, composition, manufacture, expiry) 
  			  VALUES('$medcode', '$medname', '$composition','$mandate','$expdate')";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "Successfully added a medicine";
  	header('location: home.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">
function myfunc()
{
var id1= document.getElementsByName("medcode");
var id2= document.getElementsByName("medname");
var id3= document.getElementsByName("composition");
var id4= document.getElementsByName("mandate");
var id5= document.getElementsByName("expdate");
if(id1[0].value.length==0&&id2[0].value.length==0&&id3[0].value.length==0&&id4[0].value.length==0&&id5[0].value.length==0)
{
 alert(	"Please enter all the details");
 id1.focus();
 return false;
}

else
	return true;
}
</script>
</head>
<body style="background-image:url(medical4.jpg);background-repeat:no-repeat;background-position:center;background-size:cover">

<div class="header">
	<h2>Add a medicine</h2>
</div>
<form method="post" action="add.php" onSubmit="myfunc()">
   <div class="input-group">
    <label>Medicine code</label>
   <input type="text" name="medcode" >
  	</div>
  	<div class="input-group">
  		<label>Medicine name</label>
  		<input type="text" name="medname">
  	</div>
  	<div class="input-group">
  		<label>Composition</label>
  		<input type="text" name="composition">
  	</div>
	<div class="input-group">
	    <label>Manufacture date</label>
		<input type="text" name="mandate">
	</div>
	<div class="input-group">
	    <label>Expiry date</label>
		<input type="text" name="expdate">
	</div>
    <div class="input-group">
  		<button type="submit" class="btn" name="add">Add</button>
  	</div>
	<a href="home.php">Go back</a>
</form>   
</body>
</html>
