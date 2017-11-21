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
$sql="SELECT reading FROM `meter` WHERE `meterno`='".$meterno."';;";
$result=$conn->query($sql);
    // output data of each row
$row = $result->fetch_assoc(); 
		
$kwh=$row["reading"];
$billamount=$kwh*$cpu;
echo '<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>Smart Meter</title>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="meter1/styles/layout.css" type="text/css">
<!--[if lt IE 9]><script src="meter1/scripts/html5shiv.js"></script><![endif]-->
<script>
		  function validateForm() {
		  var val = document.getElementById("cardno").value;
		if (/^\d{16}$/.test(val)) {
    // value is ok, use it
		} 
		else {
			alert("Invalid card Number");
			document.getElementById("cardno").focus() ;
			return false;
		}
		}
</script>
</head>
<body>
<div class="wrapper row1">
  <header id="header" class="clear">
    <div id="hgroup">
      <h1><a href="meter1.php">Smart Meter</a></h1>
    </div>
    <nav>
      <ul>
        <li class="last"><a href="logout.php">Log Out</a></li>
      </ul>
    </nav>
  </header>
</div>
<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- Slider -->
    <!-- main content -->
    <div id="homepage">
      <!-- services area -->
      <section id="services" class="clear">
        <!-- article 1 -->
        <article class="one_third">
          <h2>Pay Rs.';
echo $billamount;
echo '</h2>
          </article>
		  
        </section>
		<form action="gateway.php" method="post">
		  <label class="card">Enter Card No.<input type="text" name="cardno" id="cardno"/></label>
		  <input type="submit" value="Pay" onclick="return(validateForm());"/>
		  </form>
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