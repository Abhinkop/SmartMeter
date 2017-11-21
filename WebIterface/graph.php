<?php
require "/jpgraph/src/jpgraph.php";
require "jpgraph/src/jpgraph_line.php";

$graph = new Graph(300, 400); //300 is the width and 400 is the height
$graph->SetScale("intint"); //set the scale of the graph
$data = array(2, 2, 5, 6, 7, 8);
$plot = new LinePlot($data);
$graph->Add($plot);
$graph->Stroke();
?>