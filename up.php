<?php 
session_start();

$medcode=0;
$errors=array();
$upcode ="";
$newcode="";

$db=mysqli_connect('localhost','root','','registration');

if(isset($_POST['update']))
{
	$medcode=mysqli_real_escape_string($db, $_POST['medcode']);
	$upcode=mysqli_real_escape_string($db, $_POST['upcode']);
	$newcode=mysqli_real_escape_string($db, $_POST['newvalue']);

if (empty($medcode)) 
{ 
array_push($errors, "Medicine code is required"); 
}
if(empty($upcode))
{
	array_push($errors ,"Attribute is required");
}
if(empty($newcode))
{
	array_push($errors ,"New value is required");
}

$user_check_query = "SELECT * FROM medicine WHERE med_code='$medcode' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $medicine = mysqli_fetch_assoc($result);
  
  //if (!$medicine) { // if user exists
  //  if ($medicine['med_code'] !== $medcode) {
  //    array_push($errors, "Medicine doesn't exists");
   // }
  //}

 if(count($errors)==0)
 {
	 if(strcmp($upcode,"Name")==0)
	 {
	 $query = "UPDATE medicine SET med_name='$newcode' where med_code=$medcode";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "Successfully updated a medicine";
  	header('location: home.php');
	 }
	 else if(strcmp($upcode,"Composition")==0)
	 {
		 $query = "UPDATE medicine SET Composition='$newcode' where med_code=$medcode";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "Successfully updated a medicine";
  	header('location: home.php');
	 }
	 else if(strcmp($upcode,"Manufacture")==0)
	 {
		 $query = "UPDATE medicine SET manufacture='$newcode' where med_code=$medcode";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "Successfully updated a medicine";
  	header('location: home.php');
	 }
	 else if(strcmp($upcode,"Expiry")==0)
	 {
		 $query = "UPDATE medicine SET expiry='$newcode' where med_code=$medcode";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "Successfully updated a medicine";
  	header('location: home.php');
	 }
	 else
	 {
		 $query = "UPDATE medicine SET med_code='$newcode' where med_code=$medcode";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "Successfully updated a medicine";
  	header('location: home.php');
	 }
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
var id2= document.getElementsByName("upcode");
var id3= document.getElementsByName("newvalue");
if(id1[0].value.length==0&&id2[0].value.length==0&&id3[0].value.length==0)
{
 alert(	"Please enter all details");
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
	<h2>Update a medicine</h2>
</div>
<form method="post" action="up.php" onSubmit="myfunc()">
   <div class="input-group">
    <label>Enter the Medicine code of the medicine to be updated</label>
   <input type="text" name="medcode" >
  	</div>
	<div class="input-group">
    <label>Enter the parameter of the medicine to be updated</label>
   <input type="text" name="upcode" >
  	</div>
	<div class="input-group">
    <label>Enter the updated value</label>
   <input type="text" name="newvalue" >
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="update">Update</button>
  	</div>
	<a href="home.php">Go back</a>
</form>   

		
</body>
</html>