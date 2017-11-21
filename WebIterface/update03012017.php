<?php
require "dbdetails.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql="UPDATE `meter` SET `reading` = '".$_GET["reading"]."' WHERE `meter`.`meterno` = '".$_GET["meterno"]."'";
$executed=array();
$executed[0]=$conn->query($sql);
$sql="INSERT INTO `meterrecords` (`mrmno`, `mrreading`) VALUES ('".$_GET["meterno"]."', '".$_GET["reading"]."')";
$executed[1]=$conn->query($sql);
for($z=1;$z<7;$z++)
{
if(isset($_GET['R'.$z]))
{
	$sql = "UPDATE `room` SET `rreading` = '".$_GET['R'.$z]."' WHERE `room`.`mno` = '".$_GET["meterno"]."' AND `room`.`rno` = 'R".$z."'";
	$executed[($z+1)]=$conn->query($sql);
	$sql = "INSERT INTO `roomrecords` (`rrmno`, `rrrno`, `rrreading`) VALUES ('".$_GET['meterno']."', 'R".$z."', '".$_GET['R'.$z]."')";
	$executed[($z+1)]=$executed[($z+1)] and ($conn->query($sql));
	
}
} 
 $y=true;
 for($z=0;$z<count($executed);$z++)
{
	$y=$y and $executed[$z];
}
if($y==true){
echo "recordinserted2414";
} else {
    echo "Error: ";
}

$sql = "SELECT billpaid,costchanged FROM `meter` WHERE meter.meterno='".$_GET['meterno']."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
    // output data of each row
		while($row = $result->fetch_assoc()) 
		{
			if($row["billpaid"]==true)
			{
				$sql="UPDATE `meter` SET `reading` = '0' WHERE `meter`.`meterno` = '".$_GET["meterno"]."'";
				$conn->query($sql);
				$sql = "UPDATE `room` SET `rreading` = '0' WHERE `room`.`mno` = '".$_GET["meterno"]."'";
				$executed[($z+1)]=$conn->query($sql);
				$sql = "UPDATE `meter` SET `reading` = '0' WHERE `meter`.`meterno` = '".$_GET["meterno"]."'";
				$conn->query($sql);
				$sql = "UPDATE `room` SET `rreading` = '0' WHERE `room`.`mno` = '".$_GET["meterno"]."';";
				$conn->query($sql);
				$sql = "UPDATE `meter` SET `billpaid` = '0' WHERE `meter`.`meterno` = '".$_GET["meterno"]."'";
				$conn->query($sql);
				echo "<br/>reset2414<br/>";
			
			}
			if($row["costchanged"]==true)
			{
			$sql1 = "SELECT *from cost";
			$result1 = $conn->query($sql1);
			$row1=$result1->fetch_assoc();
						echo "costchanged2414<br/>";
						echo "!!!".$row1["costperunit"]."!!!";
						$sql = "UPDATE `meter` SET `costchanged` = '0' WHERE `meter`.`meterno` = '".$_GET["meterno"]."'";
						$conn->query($sql);
						break;
						
				
			}
		}
}
$conn->close();
?>