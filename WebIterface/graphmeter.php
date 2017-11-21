<?php
require "dbdetails.php";
require "jpgraph/src/jpgraph.php";
require "jpgraph/src/jpgraph_line.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$meterno=$_GET["mno"];
$sql = "SELECT `mrreading` AS reading FROM `meterrecords` WHERE mrmno='".$meterno."';";
$result = $conn->query($sql);
$i=0;
$data=array();
if ($result->num_rows > 0) 
{
    // output data of each row
		while($row = $result->fetch_assoc()) 
		{
			$data[$i]=$row["reading"];
			$i++;
		}
		
}

$graph = new Graph(630, 300); //300 is the width and 400 is the height
$graph->SetScale("linlin"); //set the scale of the graph
//$data = array(2, 2, 5, 6, 7, 8);
$graph->ygrid->Show(false, false);
$graph->SetColor('navy');
$graph->xaxis->SetTitle("TIME","center"); 
$graph->yaxis->SetTitle("KWH","center");
$graph->yaxis->SetTitleMargin(20);	
$graph->yaxis->SetColor("red");
$plot = new LinePlot($data);
$graph->Add($plot);
$graph->Stroke();
$conn->close();
?>