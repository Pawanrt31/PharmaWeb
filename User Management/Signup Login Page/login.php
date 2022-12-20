<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Your Pharmacy</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript">
function myfunc()
{
var id1= document.getElementsByName("username");
var id2= document.getElementsByName("password");
if(id1[0].value.length==0&&id2[0].value.length==0)
{
 alert(	"Please enter all the details");
 id1.focus();
 return false;
}
if(id2[0].value.length==0)
{
	alert("Enter password");
	id2.focus();
	return false;
}
else
	return true;
}
</script>
</head>
<body style="background-image:url(medical4.jpg);background-repeat:no-repeat;background-position:center;background-size:cover">
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php" onSubmit="myfunc()">
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
	<p>
	   User? <a href="users.php">Click here</a>
	 </p>
  </form>
</body>
</html>