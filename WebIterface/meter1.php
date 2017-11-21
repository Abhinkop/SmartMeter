<?php
session_start();
if(isset($_SESSION["logedin"]) and ($_SESSION["logedin"]==true))
{	
require "dbdetails.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$meterno=$_SESSION["meterno"];
$sql="SELECT COSTPERUNIT FROM `cost`;";
$result=$conn->query($sql);
    // output data of each row
$row = $result->fetch_assoc(); 
		
$cpu=$row["COSTPERUNIT"];
echo '<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>Smart Meter</title>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="meter1/styles/layout.css" type="text/css">
<!--[if lt IE 9]><script src="meter1/scripts/html5shiv.js"></script><![endif]-->
</head>
<body>
<div class="wrapper row1">
  <header id="header" class="clear">
    <div id="hgroup">
      <h1><a href="#">Smart Meter</a></h1>
    </div>
    <nav>
      <ul>
        <li>Cost Per Unit:';
echo $cpu;
$sql="SELECT reading FROM `meter` WHERE `meterno`='".$meterno."';;";
$result=$conn->query($sql);
    // output data of each row
$row = $result->fetch_assoc(); 
		
$kwh=$row["reading"];
$billamount=$kwh*$cpu;
echo "</li>
        <li><a href=\"paybill.php\">Pay Bill</a></li>
        <li><a href=\"changepass.php\">Change Paassword</a></li>
        <li class=\"last\"><a href=\"logout.php\">Log Out</a></li>
      </ul>
    </nav>
  </header>
</div>
<!-- content -->
<div class=\"wrapper row2\">
  <div id=\"container\" class=\"clear\">
    <!-- Slider -->
    <section id=\"slider\" class=\"clear\">
      <figure><p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	  Power Consumption graph</p><img src=\"graphmeter.php?mno=".$meterno."\" alt=\"\">
        <figcaption>
          <h2>Bill Amt: Rs ";
echo $billamount;
echo '</h2>
          <p>Power Consumed:<u>';
echo $kwh;
echo 'KwH</u><br/>';

$sql="SELECT COUNT(DISTINCT(rno)) AS nor FROM `room` where `mno`='".$meterno."';";
$result=$conn->query($sql);
    // output data of each row
$row = $result->fetch_assoc(); 
		
$noofrooms=intval($row["nor"]);
$sum=0;
for($i=1;$i<=$noofrooms;$i++)
{
	
	$sql="SELECT `rreading` FROM `room` WHERE `mno`='".$meterno."' AND `rno`='R".$i."';";
	$result=$conn->query($sql);
    // output data of each row
	$row = $result->fetch_assoc(); 
		
	$roomkwh=$row["rreading"];
	$sum=$sum+$roomkwh;
	$roombill=$roomkwh*$cpu;
	echo 'Power Consumed by room';
	echo $i;
	echo ':<u>';
	echo $roomkwh;
	echo 'KwH</u><br/>Bill Amt of room';
	echo $i;
	echo ':<u>Rs.';
	echo $roombill;
	echo '</u><br/>';
}
echo '</p>
         </figcaption>
      </figure>
    </section>';

echo "<div id=\"homepage\">
      <!-- services area -->
      <section id=\"services\" class=\"clear\">
        <!-- article 1 -->";
		if($sum!=0)
		{	
        echo "<article class=\"one_third\">
          <h2>Consumption Between Rooms</h2>
          <img src=\"piemeter.php?mno=".$meterno."\" alt=\"\"/>
          </article>";
		}
for($i=1;$i<=$noofrooms;$i++)
{
	echo "<article class=\"one_third\">
          <h2>Comsumption Graph For Room".$i."</h2>
          <img src=\"roomgraph.php?mno=".$meterno."&rno=R".$i."\" alt=\"\"/>
        </article>
        ";

}

echo '</section>
      <!-- / One Quarter -->
    </div>
    <!-- / content body -->
  </div>
</div>
<!-- Footer -->
<div class="wrapper row3">
  <footer id="footer" class="clear">
    <p class="fl_left">Copyright &copy; 2012 - All Rights Reserved - <a href="#">Domain Name</a></p>
  </footer>
</div>
</body>
</html>
';
$conn->close();
}
else
{
	header('Location: customerlogin.html');
}
?>