

<?php

$servername = "localhost";
$username = "root";
$password = "Arduino@11";


if ( isset( $_POST['com1'])? $_POST['com1'] : false ) {

//echo '<h2>form data retrieved by using $_POST variable<h2/>';
}

$Item1 = $_REQUEST['com1'];
$Item2 = $_REQUEST['com2'];

$w1=$_REQUEST['weight1'];
$w2=$_REQUEST['weight2'];


echo "Items chosen are : ".$Item1.",  ".$Item2."<br> Weights given are : ".$w1.", ".$w2 ;

try {
    $conn = new PDO("mysql:host=$servername;dbname=SmartLunchBox", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo " <br> Connected to db successfully"."<br>"; 
    
    $riceCal = "SELECT Items,Calories FROM Food";
    $result = $conn->query($riceCal);
    
    $Item1query = "SELECT Calories,carbs,protein,fat FROM Food where Items='".$Item1."'";
    $Item1Cal=$conn->query($Item1query);
    
    $Item2query = "SELECT Calories,carbs,protein,fat FROM Food where Items='".$Item2."'";
    $Item2Cal=$conn->query($Item2query);
    
    foreach ($Item1Cal as $row)
    {
    	//echo $row['Calories']."<br>";
    	$cal1=$row['Calories'];
    	$carb1=$row['carbs'];
    	$prot1=$row['protein'];
    	$fat1=$row['fat'];
    }
//     echo $Item1." calories are = ".$cal1.",carbs = ".$carb1.",protein = ".$prot1.", fat = ".$fat1;
//     echo "<br> ";
    
    foreach ($Item2Cal as $row)
    {
    	//echo $row['Calories']."<br>";
    	$cal2=$row['Calories'];
    	$carb2=$row['carbs'];
    	$prot2=$row['protein'];
    	$fat2=$row['fat'];
    }
//     echo $Item2." calories are = ".$cal2.",carbs = ".$carb2.",protein = ".$prot2.", fat = ".$fat2;
//     echo "<br> <br><br>";
    
    //100gms is chosen as standard weight
    $actualCal1= ($cal1*$w1)/100;
//     $actualcarb1 = ($carb1*$w1)/100;
//     $actualprot1=($prot1*$w1)/100;
//     $actualfat1=($fat1*$w1)/100;
    
//     echo "Actual ". $Item1." calories are = ".$actualCal1; //",carbs = ".$actualcarb1.",protein = ".$actualprot1.", fat = ".$actualfat1;
//     echo "<br> ";
    
    
     $actualCal2= ($cal2*$w2)/100;
//     $actualcarb2 = ($carb2*$w2)/100;
//     $actualprot2=($prot2*$w2)/100;
//     $actualfat2=($fat2*$w2)/100;
    
    
//     echo "Actual ". $Item2." calories are = ".$actualCal2; //.",carbs = ".$actualcarb2.",protein = ".$actualprot2.", fat = ".$actualfat2;
//     echo "<br> ";
    
    $avgCarb=($carb1+$carb2)/2;
    $avgProt=($prot1+$prot2)/2;
    $avgfat=($fat1+$fat2)/2;
    $totalCal=$actualCal1+$actualCal2;

//     echo $totalCal."<br>";
// 
// 	//fetch tha data from the database 
// 	foreach ($result as $row) {
// 		echo $row['Items']." - ".$row['Calories']."<br>";  // echo "id: " .$row["Calories"]."<br>";
// 		}
    }
    
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>


<html>
<head>
<title>Nutrition today</title>
<style>
body {
/*   background-color: yellow; */
  background-image: radial-gradient(red, yellow, green);
  background-color: #cccccc;
  text-align: center;
  color: black;
  font-family: Arial, Helvetica, sans-serif;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
  text-align: left;
}
table#t01 tr:nth-child(even) {
  background-color: #eee;
}
table#t01 tr:nth-child(odd) {
 background-color: #fff;
}
table#t01 th {
  background-color: black;
  color: white;
}
</style>
</head>
<body>

<!-- this is second page-->

<h1>Results</h1>
<!--<p>This is a paragraph.</p>-->
<table id="t01" style="width:600px" align="center">
  <tr>
    <th>Item</th>
    <th>Calories</th> 
    <th>Carbs %</th>
    <th>Protein %</th>
    <th>Fat %</th>
  </tr>
  <tr>
    <td><?=$Item1?></td>
    <td><?=$actualCal1?></td>
    <td><?=$carb1?></td>
    <td><?=$prot1?></td>
    <td><?=$fat1?></td>
  </tr>
  <tr>
    <td><?=$Item2?></td>
    <td><?=$actualCal2?></td>
    <td><?=$carb2?></td>
    <td><?=$prot2?></td>
    <td><?=$fat2?></td>
  </tr>
</table>
<br>
<p> Total calories of the meal = <?=$totalCal?></p>
<br>
<br>
<table id="t01" style="width:300px" align="center">
  <tr>
    <th></th>
    <th>Average %</th> 

  </tr>
  <tr>
    <td>Carbs</td>
    <td><?=$avgCarb?></td>

  </tr>
  <tr>
    <td>Protein</td>
    <td><?=$avgProt?></td>

  </tr>
  <tr>
    <td>Fats</td>
    <td><?=$avgfat?></td>

  </tr>
</table>

</body>
</html>
