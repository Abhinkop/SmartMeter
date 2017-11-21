<?php
/*$servername = "mysql7.000webhost.com";
$username = "a2407222_abhin";
$password = "abhin123";
$dbname = "a2407222_testdb";
*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartmeter";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
$sql="UPDATE `meter` SET `reading` = '".$_GET["reading"]."' WHERE `meter`.`meterno` = '".$_GET["meterno"]."'";
echo $sql;
echo"<br/>";
$executed=array();
$executed[0]=$conn->query($sql);
$sql="INSERT INTO `meterrecords` (`mrmno`, `mrreading`) VALUES ('".$_GET["meterno"]."', '".$_GET["reading"]."')";
$executed[1]=$conn->query($sql);
for($z=0;$z<7;$z++)
{
if(isset($_GET['R'.$z]))
{
	echo $_GET['R'.$z];
	echo "\n";
	
	$sql = "UPDATE `room` SET `rreading` = '".$_GET['R'.$z]."' WHERE `room`.`mno` = '".$_GET["meterno"]."' AND `room`.`rno` = 'R".$z."'";
	$executed[$z+2]=$conn->query($sql);
	$sql = "INSERT INTO `roomrecords` (`rrmno`, `rrrno`, `rrreading`) VALUES ('".$_GET['meterno']."', 'R".$z."', '".$_GET['R'.$z]."')";
	$executed[$z+2]=$executed[$z+2]&&($conn->query($sql));
	
}
}
/* $y=true;
for($z=0;$z<count($executed);$z++)
	$y=$y&&$executed[$z];

if($y==true)
echo "recordinserted2414";
} else {
    echo "Error: ";
}*/
$conn->close();
?>