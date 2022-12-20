<?php 
session_start();

$medcode=0;
$errors=array();

$db=mysqli_connect('localhost','root','','registration');

if(isset($_POST['delete']))
{
	$medcode=mysqli_real_escape_string($db, $_POST['medcode']);

if (empty($medcode)) 
{ 
array_push($errors, "Medicine code is required"); 
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
	 $query = "DELETE FROM medicine where med_code=$medcode";
  	mysqli_query($db, $query);
  	$_SESSION['success'] = "Successfully removed a medicine";
  	header('location: home.php');
  }
}
  ?>