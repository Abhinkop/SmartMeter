<?php
session_start();
if(isset($_SESSION['admin']) and ($_SESSION['admin']==true))
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
		
		<script>
		  function validateForm() {
	
		  var val = document.forms["af-form"]["cpu"].value;
		if (/^\d+.\d+$|^\d+$/.test(val)) {
    // value is ok, use it
		} 
		else {
			alert("Enter a valid Number");
			document.getElementById("cpu").focus() ;
			return false;
		}
		  
			
			}
			
			

		</script>
		
		
		
		
		
		
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
				<h1>Change Cost per Unit kWH<span></span></h1>
				
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
	            <h3></h3>
		        
				
				<form class="af-form" method="post" action="updatecost.php" id="af-form">     <!--      form values submited  hereeeeeeeeeeeeeeeeeeeeeeeeeeeeee -->
				
					<div class="af-outer ">
						<div class="af-inner">
						  <label for="input-country">Enter New Cost per Unit kWH</label>
						  <input type="text" name="cpu" id="cpu" required>
						</div>
					</div>
					
					<input type="submit" value="Change Cost per Unit kWH !" onclick="return(validateForm());" /> 
					
				</form>
			</section>
        </div>
    </body>
</html>';
}
else
{
header('Location: admin.html');
}

?>