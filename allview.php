<?php
   
   $conn = mysql_connect('localhost','root','','registration');
   
   if(! $conn ) {
      die('Could not connect: ' . mysql_error());
   }
   $sql = 'SELECT med_code,med_name,composition,manufacture,expiry
      FROM medicine';

   mysql_select_db('registration');
   $retval = mysql_query( $sql, $conn );
   
   if(! $retval ) {
      die('Could not get data: ' . mysql_error());
   }
   
   while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
      echo "Medicine Code :{$row['med_code']}  <br> ".
         "Medicine Name: {$row['med_name']} <br> ".
         "Composition: {$row['composition']} <br> ".
         "Manufacture Date : {$row['manufacture']} <br> ".
		 "Expiry Date: {$row['expiry']} <br>".
         "--------------------------------<br>";
   } 
   echo "Fetched data successfully\n";
   mysql_close($conn);
?>