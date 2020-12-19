<?php

$servername = "localhost"; 
$username = "root";
$password = "Arduino@11";
$dbname = "SmartLunchBox";

//connection to the database
//$dbhandle = mysql_connect($servername, $username, $password);
 
 // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

//die("Unable to connect to MySQL");
if (!$conn) {
	    	die('MySQL ERROR: ' . mysql_error());
		}else
echo "Connected to MySQL<br>";


//select a database to work with
//$selected = mysql_select_db("SmartLunchBox",$dbhandle);
 // or die("Could not select examples");

//execute the SQL query and return records
$riceCal = mysql_query("SELECT calories FROM Food where item='Rice'");

//fetch tha data from the database 
while ($row = mysql_fetch_array($result)) {
   echo("calories in rice = ",$riceCal);
}
//close the connection
mysql_close($dbhandle);
?>
