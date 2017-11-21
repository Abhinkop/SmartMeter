<?php

echo $_GET['meterno'];
echo "\n";
echo $_GET['reading'];
echo "\n";
$sql="UPDATE `meter` SET `reading` = '".$_GET["reading"]."' WHERE `meter`.`meterno` = '".$_GET["meterno"]."'";
	echo $sql;
	echo "<br/>";

$sql="INSERT INTO `meterrecords` (`mrmno`, `mrreading`) VALUES ('".$_GET["meterno"]."', '".$_GET["reading"]."')";
	echo $sql;
	echo "<br/>";

for($z=0;$z<7;$z++)
{
if(isset($_GET['R'.$z]))
{
	echo $_GET['R'.$z];
	
	echo "<br/>";
	$sql = "INSERT INTO `roomrecords` (`rrmno`, `rrrno`, `rrreading`) VALUES ('".$_GET['meterno']."', 'R".$z."', '".$_GET['R'.$z]."')";
	echo $sql;
	echo "<br/>";
	$sql = "UPDATE `room` SET `rreading` = '".$_GET['R'.$z]."' WHERE `room`.`mno` = '".$_GET["meterno"]."' AND `room`.`rno` = 'R".$z."'";
	echo $sql;
	echo "<br/>";
	
}

}
$x=array();
$x[0]=true;
$x[1]=false;
$y=true;
for($z=0;$z<count($x);$z++)
	$y=$y&&$x[$z];
if(($y)==true)
	echo "ola";
?>