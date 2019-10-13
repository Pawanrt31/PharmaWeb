//php code to search for a medicine
<?php 
 $db = mysql_connect('localhost','root','','');
   $param ="";
   $errors=array();
   $raw_results=0;
   //$searchq ="";
   if(! $db ) {
      die('Could not connect: ' . mysql_error());
   }
   mysql_select_db("registration") or die(mysql_error());
   if(isset($_POST['search']))
   {
   $query = $_POST['medname']; 
    // gets value sent over search form
   $min_length = 3;
    // you can set minimum length of the query if you want
   if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
        if (empty($query)) { array_push($errors, "Medicine name is required");}
        $query = mysql_real_escape_string($query);
        $raw_results = mysql_query("SELECT * FROM medicine
            WHERE (`med_name` LIKE '%".$query."%')") or die(mysql_error());
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysql_num_rows($raw_results)==0){ // if one or more rows are returned do following
            echo "No results";
        }
   }
   }
   else{
	   header("location: search.php");
   }
  ?>
<!DOCTYPE html>
<html>
<head>
<title>Admin</title>
<style>
table, th, td {
    border: 1px solid black;
}
.header {
  width: 30%;
  margin: 50px auto 0px;
  color: white;
  background: #5F9EA0;
  text-align: center;
  border: 1px solid #B0C4DE;
  border-bottom: none;
  border-radius: 10px 10px 0px 0px;
  padding: 20px;
}
</style>
<!--<link rel="stylesheet" type="text/css" href="style.css">!-->
</head>
<body style="background-image:url(medical4.jpg);background-repeat:no-repeat;background-position:center;background-size:cover">
<div class="header">
	<h2> medicine</h2>
</div>
<body>
<table align="center">
	<thead>
		<tr>
			<th>Medicine code</th>
			<th>Medicine name</th>
			<th>Composition</th>
			<th>Manufacture date</th>
			<th>Expiry date</th>
			
		</tr>
	</thead>
	
	<?php while ($row = mysql_fetch_array($raw_results, MYSQL_ASSOC)) { ?>
		<tr>
			<td><?php echo $row['med_code']; ?></td>
			<td><?php echo $row['med_name']; ?></td>
			<td><?php echo $row['composition']; ?></td>
			<td><?php echo $row['manufacture']; ?></td>
			<td><?php echo $row['expiry']; ?></td>
			
		</tr>
	
	<?php } ?>
</table>
<a href="search.php">Go back?</a>
</body>
</html>
