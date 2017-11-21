<?php
session_start();
if(isset($_SESSION["logedin"]) and ($_SESSION["logedin"]==true))
{	

require "dbdetails.php";
function pay()
{
	return true;
}

$result=pay();
$meterno=$_SESSION["meterno"];
$cid=$_SESSION["cid"];
if($result)
{
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql="UPDATE `meter` SET `reading` = '0', `billpaid` = '1' WHERE `meter`.`ccid` = ".$cid." AND `meter`.`meterno` = '".$meterno."'";
$conn->query($sql);
$sql="UPDATE `room` SET `rreading` = '0' WHERE `room`.`mno` = '".$meterno."'";
$conn->query($sql);
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
          <h2>Bill Paid</h2>
          </article>
		  
        </section>
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
}
else
{
	
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
          <h2>Error Try Again</h2>
          </article>
		  
        </section>
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
}
$conn->close();
}
else
{
	header('Location: customerlogin.html');
}


?>