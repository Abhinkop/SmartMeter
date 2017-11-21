<?php
session_start();
if(isset($_SESSION['admin']) and ($_SESSION['admin']==true))
{

echo '<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Add Meter </title>
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
			alert("Invalid number of rooms");
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
				<h1>Enter Meter Details<span>!</span></h1>
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
	            <h3>Enter the following details to add meter</h3>
		        
				
				<form class="af-form" method="post" action="addmeter.php" id="af-form">     <!--      form values submited  hereeeeeeeeeeeeeeeeeeeeeeeeeeeeee -->
				
					<div class="af-outer af-required">
						<div class="af-inner">
							<label for="input-title">Customer id:</label>
							<input type="text" name="cid" id="cid">
						</div>
					</div>
				
					<div class="af-outer af-required">
						<div class="af-inner">
							<label for="input-name">Meter no.</label>
							<input type="text" name="mno" id="mno" >
						</div>
					</div>
					
					<div class="af-outer">
						<div class="af-inner">
						  <label for="input-phone">No. Of Rooms</label>
						  <input type="text" name="nor" id="nor">
						</div>
					</div>
					
					<input type="submit" value="Add Meter !" onclick="return(validateForm());" /> 
					
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