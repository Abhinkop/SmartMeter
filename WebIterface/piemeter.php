<?php
require "dbdetails.php";
require "jpgraph/src/jpgraph.php";
require "jpgraph/src/jpgraph_pie.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$meterno=$_GET["mno"];
$data=array();
$sql="SELECT COUNT(DISTINCT(rno)) AS nor FROM `room` where `mno`='".$meterno."';";
$result=$conn->query($sql);
    // output data of each row
$row = $result->fetch_assoc(); 
		
$noofrooms=intval($row["nor"]);
for($i=1;$i<=$noofrooms;$i++)
{
	$sql="SELECT `rreading` FROM `room` WHERE `mno`='".$meterno."' AND `rno`='R".$i."';";
	$result=$conn->query($sql);
    // output data of each row
	$row = $result->fetch_assoc(); 
		
	$data[$i-1]=$row["rreading"];
	}

$graph = new PieGraph(250, 250); //300 is the width and 400 is the height
$graph->SetShadow();
$graph->title->Set("");
$p1 = new PiePlot($data);
$graph->Add($p1);
$graph->Stroke();
$conn->close();
?>