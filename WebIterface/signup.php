<?php
session_start();
if(isset($_SESSION['admin']) and ($_SESSION['admin']==true))
{

require "dbdetails.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `customer` (`cid`, `name`, `address`, `mobile`, `email`, `password`) VALUES (NULL, '".$_POST["name"]."', '".$_POST["address"]."', '".$_POST["mobile"]."', '".$_POST["email_address"]."', '".$_POST["password"]."');";
if ($conn->query($sql) === TRUE) {
    
	echo '<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Customer Sign Up </title>
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
	            <h3>Customer Added and <u>Customer ID: <span style="color:red;">';
$sql = 'SELECT cid FROM customer WHERE name=\''.$_POST["name"].'\' AND address=\''.$_POST["address"].'\' AND mobile=\''.$_POST["mobile"].'\' AND email=\''.$_POST["email_address"].'\' AND password=\''.$_POST["password"].'\';';
$result=$conn->query($sql);
$row=$result->fetch_assoc(); 
echo $row['cid'].'</span></u></h3>
		        <h2></h2>
			</section>
        </div>
    </body>
</html>';
	
} else {
    echo '<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Customer Sign Up </title>
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
	            <h3>Error</h3>
		        <h2></h2>
			</section>
        </div>
    </body>
</html>';
}

$conn->close();
}
else
{
header('Location: admin.html');
}

?>