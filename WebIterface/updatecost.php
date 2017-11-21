<?php
session_start();
if(isset($_SESSION['admin']) and ($_SESSION['admin']==true))
{

require "dbdetails.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql="UPDATE cost SET `costperunit`='".$_POST["cpu"]."';";
$result=$conn->query($sql);
$sql="UPDATE `meter` SET `costchanged` = '1';";
$result=$result and ($conn->query($sql));
if($result)
{
	echo '<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Change Cost Per Unit </title>
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
		
    </head>
    <body>
	
	
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
				<h1>Cost per Unit kWH Changed<span></span></h1>
				
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
	            <h3>Cost per Unit kWH Changed!</h3>
		        
				
			</section>
        </div>
    </body>
</html>
';
}
else
{
echo '<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Change Cost Per Unit </title>
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
		
    </head>
    <body>
	
	
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
				<h1>Error<span>!</span></h1>
				
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
	            <h3>Please try again later!</h3>
		        
				
			</section>
        </div>
    </body>
</html>
';	
}
}
else
{
header('Location: admin.html');
}

?>