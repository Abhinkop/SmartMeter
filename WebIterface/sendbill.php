<?php
session_start();
if(isset($_SESSION['admin']) and ($_SESSION['admin']==true))
{
require "dbdetails.php";
require "mail.php";
require "sms.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql="SELECT costperunit FROM `cost`";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$cpu=$row["costperunit"];
$sql="SELECT ccid,meterno,reading FROM `meter`";
$result=$conn->query($sql);
$sentsms=true;
$sentmail=true;
if($result->num_rows>0)
{
	
while($row = $result->fetch_assoc())
{
	$cid=$row["ccid"];
	$mno=$row["meterno"];
	$kwh=$row["reading"];
	//echo $cid.$mno;
	$sql="SELECT name,mobile,email FROM `customer` where cid='".$cid."'";
	$result1=$conn->query($sql);
	if($result1->num_rows>0)
		$row1 = $result1->fetch_assoc();
	$mob=$row1["mobile"];
	$email=$row1["email"];
	$name=$row1["name"];
//	echo $mob.$email.$name;
		$sentsms=$sentsms and (sendsms($name,$kwh,$cpu,$mob));
		$sentmail=$sentmail and (sendmail($name,$kwh,$mno,$cpu,$email));
		//sleep(5);
}
}
if($sentsms and $sentmail)
{
	echo '<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Bills Sent</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Enhance Required Form Fields with CSS3" />
        <meta name="keywords" content="form, html5, css3, animated, transition, required, filter" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style2.css" />
		<script type="text/javascript" src="js/modernizr.custom.04022.js"></script>
		<!--[if lt IE 8]>
			<style>
				.af-wrapper{display:none;}
				.ie-note{display:block;}
			</style>
		<![endif]-->
		
		<script>
		  function validateForm() {
		  var phoneno = /^\d+$/;
			
			var val = document.forms["af-form"]["cid"].value;
		if (/^\d+$/.test(val)) {
    // value is ok, use it
		} 
		else {
			alert("Invalid Customer ID");
			document.getElementById("cid").focus() ;
			return false;
		}
		  
		  var phoneno = /^\d{10}$/;
			
			var val = document.forms["af-form"]["mno"].value;
		if (/^\d{10}$/.test(val)) {
    // value is ok, use it
		} 
		else {
			alert("Invalid meter number; must be ten digits");
			document.getElementById("mno").focus() ;
			return false;
		}
		  var phoneno = /^\d{10}$/;
			
			var val = document.forms["af-form"]["nor"].value;
		if (/^\d+$/.test(val)) {
    // value is ok, use it
		var x=parseInt(val);
		if(x<1 || x>6)
		{
			alert("Number of rooms should be between 1 and 6");
			document.getElementById("nor").focus() ;
			return false;
			}
		} 
		else {
			alert("Invalid number");
			document.getElementById("nor").focus() ;
			return false;
		}
		  
		  
		  
			}
			
			

		</script>
		
		
		
		
		
		
    </head>
    <body>
	<!-- <a href="Administrator.html"><img src="images/home.png" width="50pz" height="50px"></a>
	<div style="text-align:right;">
	<nav class="codrops-demos">
	<a href="Administrator.htmls">Logout</a>
	</nav></div>
	 -->
	
	
	
        <div class="container">
			<!-- Codrops top bar -->
            <div class="codrops-top">
                <a href="administrator.php">
                    <img src="images/home.png" width="10pz" height="10px">Home
                </a>
                <span class="right">
                    <a href="logoutadmin.php">
                        <strong>Logout</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div><!--/ Codrops top bar		 -->
			<header>
				<span></span>
				<h1>Hello<span>!</span></h1>
				<p>Administrator</p>
				<p class="ie-note">D\'oh!</p>
			</header>
			<nav class="codrops-demos">
					<a href="customerdetails.php">Add Customer</a>
					<a class="current-demo" href="meterdetais.php">Add Meter</a>
					<a href="sendbill.php">Send Bill</a>
					
					<a class="current-demo" href="changepassadmin.php">Change Password</a>
					<a  href="changenor.php">Change No. of Rooms</a>
					
					<a class="current-demo" href="changecost.php">Change Cost Per Unit</a>
					
				</nav>
				
			<section class="af-wrapper">
	            <h3>Bills Sent via e-mail and SMS</h3>
			</section>
        </div>
    </body>
</html>';
}
else
{
	echo '<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Bills Not Sent</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Enhance Required Form Fields with CSS3" />
        <meta name="keywords" content="form, html5, css3, animated, transition, required, filter" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style2.css" />
		<script type="text/javascript" src="js/modernizr.custom.04022.js"></script>
		<!--[if lt IE 8]>
			<style>
				.af-wrapper{display:none;}
				.ie-note{display:block;}
			</style>
		<![endif]-->
		
		<script>
		  function validateForm() {
		  var phoneno = /^\d+$/;
			
			var val = document.forms["af-form"]["cid"].value;
		if (/^\d+$/.test(val)) {
    // value is ok, use it
		} 
		else {
			alert("Invalid Customer ID");
			document.getElementById("cid").focus() ;
			return false;
		}
		  
		  var phoneno = /^\d{10}$/;
			
			var val = document.forms["af-form"]["mno"].value;
		if (/^\d{10}$/.test(val)) {
    // value is ok, use it
		} 
		else {
			alert("Invalid meter number; must be ten digits");
			document.getElementById("mno").focus() ;
			return false;
		}
		  var phoneno = /^\d{10}$/;
			
			var val = document.forms["af-form"]["nor"].value;
		if (/^\d+$/.test(val)) {
    // value is ok, use it
		var x=parseInt(val);
		if(x<1 || x>6)
		{
			alert("Number of rooms should be between 1 and 6");
			document.getElementById("nor").focus() ;
			return false;
			}
		} 
		else {
			alert("Invalid number");
			document.getElementById("nor").focus() ;
			return false;
		}
		  
		  
		  
			}
			
			

		</script>
		
		
		
		
		
		
    </head>
    <body>
	<!-- <a href="Administrator.html"><img src="images/home.png" width="50pz" height="50px"></a>
	<div style="text-align:right;">
	<nav class="codrops-demos">
	<a href="Administrator.htmls">Logout</a>
	</nav></div>
	 -->
	
	
	
        <div class="container">
			<!-- Codrops top bar -->
            <div class="codrops-top">
                <a href="administrator.php">
                    <img src="images/home.png" width="10pz" height="10px">Home
                </a>
                <span class="right">
                    <a href="logoutadmin.php">
                        <strong>Logout</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div><!--/ Codrops top bar		 -->
			<header>
				<span></span>
				<h1>Hello<span>!</span></h1>
				<p>Administrator</p>
				<p class="ie-note">D\'oh!</p>
			</header>
			<nav class="codrops-demos">
					<a href="customerdetails.php">Add Customer</a>
					<a class="current-demo" href="meterdetais.php">Add Meter</a>
					<a href="sendbill.php">Send Bill</a>
					
					<a class="current-demo" href="changepassadmin.php">Change Password</a>
					<a  href="changenor.php">Change No. of Rooms</a>
					
					<a class="current-demo" href="changecost.php">Change Cost Per Unit</a>
					
				</nav>
				
			<section class="af-wrapper">
	            <h3>Bills not Sent to every customer!please try again</h3>
			</section>
        </div>
    </body>
</html>';
}	
}
else
{
header('Location: admin.html');
}

?>