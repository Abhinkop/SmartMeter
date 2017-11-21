<?php
require "dbdetails.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$meterno="7899194973";
$sql="SELECT COSTPERUNIT FROM `cost`;";
$result=$conn->query($sql);
    // output data of each row
$row = $result->fetch_assoc(); 
		
$cpu=$row["COSTPERUNIT"];
echo $cpu;
echo "<br/>";
$sql="SELECT reading FROM `meter` WHERE `meterno`='".$meterno."';;";
$result=$conn->query($sql);
    // output data of each row
$row = $result->fetch_assoc(); 
		
$kwh=$row["reading"];
echo $kwh;
echo "<br/>";
$billamount=$kwh*$cpu;
echo $billamount;
echo "<br/>";
$sql="SELECT COUNT(DISTINCT(rno)) AS nor FROM `room` where `mno`='".$meterno."';";
$result=$conn->query($sql);
    // output data of each row
$row = $result->fetch_assoc(); 
		
$noofrooms=intval($row["nor"]);
echo $noofrooms;
echo "<br/>";
for($i=1;$i<=$noofrooms;$i++)
{
	$sql="SELECT `rreading` FROM `room` WHERE `mno`='".$meterno."' AND `rno`='R".$i."';";
	$result=$conn->query($sql);
    // output data of each row
	$row = $result->fetch_assoc(); 
		
	$roomkwh=$row["rreading"];
	echo $roomkwh;
	echo "&nbsp";
	echo ($roomkwh * $cpu);
	echo "<br/>";
}
echo "<p>Consumption Graph<br/></p><img src=\"graphmeter.php?mno=".$meterno."\"/><br/>";
echo "<p>Consumption between rooms<br/></p><img src=\"piemeter.php?mno=".$meterno."\"/><br/>";
for($i=1;$i<=$noofrooms;$i++)
{
	echo "<p>Consumption Graph for Room \"R".$i."\"<br/></p><img src=\"roomgraph.php?mno=".$meterno."&rno=R".$i."\"/><br/>";

}

?>