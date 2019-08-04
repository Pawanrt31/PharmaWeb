<?php 
 $db = mysql_connect('localhost','root','','hack');
   
   if(! $db ) {
      die('Could not connect: ' . mysql_error());
   }
   $sql = 'SELECT pno,pname,zno,zname,dno,dname,health
      FROM jss1';
	  mysql_select_db('hack');
   $results = mysql_query($sql,$db);
   if(! $results ) {
      die('Could not get data: ' . mysql_error());
   }   ?>
<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
	<h2>Panel info</h2>
</div>
<body>

<table align="center">
	<thead>
		<tr>
			<th>Panel code</th>
			<th>Panel name</th>
			<th>Zone code</th>
			<th>Zone name</th>
			<th>Device no</th>
			<th>Device name</th>
			<th>Health</th>
		</tr>
	</thead>
	
	<?php while ($row = mysql_fetch_array($results, MYSQL_ASSOC)) { ?>
		<tr>
			<td><?php echo $row['pno']; ?></td>
			<td><?php echo $row['pname']; ?></td>
			<td><?php echo $row['zno']; ?></td>
			<td><?php echo $row['zname']; ?></td>
			<td><?php echo $row['dno']; ?></td>
			<td><?php echo $row['dname']; ?></td>
			<td><?php echo $row['health']; ?></td>
		</tr>
	
	<?php } ?>
	
</table>
<p></p>
<div class="container">
  
 
  <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal">LOCATION HERE!!</button>

 
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Access the link</h4>
        </div>
        <div class="modal-body">
          <p><a href="https://www.google.co.in/maps?q=dominos+jayanagar&um=1&ie=UTF-8&sa=X&ved=0ahUKEwj-6s3l68vhAhUs6XMBHZBpAe8Q_AUIDigB">HERE GO</a></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>



              



</body>
</html>