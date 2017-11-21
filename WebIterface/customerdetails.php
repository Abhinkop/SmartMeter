<?php
session_start();
if(isset($_SESSION['admin']) and ($_SESSION['admin']==true))
{

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
		<script>
		  function validateForm() {
		  
		  if( document.forms["af-form"]["name"].value == "" )
   {
     alert( "Please provide Name!" );
     document.getElementById("input-fname").focus() ;
     return false;
   }
		  if( document.forms["af-form"]["address"].value == "" )
   {
     alert( "Please provide address!" );
     document.getElementById("input-lname").focus() ;
     return false;
   }
   	  
		  
		  
		var x = document.forms["af-form"]["email_address"].value;
		var atpos = x.indexOf("@");
		var dotpos = x.lastIndexOf(".");
		
		
   
   
   
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Not a valid e-mail address");
		document.getElementById("input-email").focus();
        return false;
			}
	if( document.forms["af-form"]["password"].value == "" )
   {
     alert( "Please enter a password!" );
     document.getElementById("input-password").focus() ;
     return false;
   }
			
			var phoneno = /^\d{10}$/;
			
			var val = document.forms["af-form"]["mobile"].value;
		if (/^\d{10}$/.test(val)) {
    // value is ok, use it
		} 
		else {
			alert("Invalid number; must be ten digits");
			document.getElementById("input-phone").focus() ;
			return false;
		}
		
			
			
			 
			
			}
			
			

		</script>
		
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
				<h1>Enter Customer Details<span>!</span></h1>
				<p></p>
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
	            <h3>Sign Up Form</h3>
		        
				
				<form class="af-form" method="post" action="signup.php" id="af-form" >     <!--      form values submited  hereeeeeeeeeeeeeeeeeeeeeeeeeeeeee -->
				
					<div class="af-outer af-required">
						<div class="af-inner">
							<label for="input-title">Name</label>
							<input type="text" name="name" id="input-fname">
						</div>
					</div>
				
					<div class="af-outer af-required">
						<div class="af-inner">
							<label for="input-name">Address</label>
							<input type="text" name="address" id="input-lname" >
						</div>
					</div>
					
					<div class="af-outer af-required">
						<div class="af-inner">
						  <label for="input-email">Email address</label>
						  <input type="email" name="email_address" id="input-email" required>
						</div>
					</div>
					
					<div class="af-outer ">
						<div class="af-inner">
						  <label for="input-country">Password</label>
						  <input type="text" name="password" id="input-password" required>
						</div>
					</div>
					
					<div class="af-outer">
						<div class="af-inner">
						  <label for="input-phone">Mobile Number</label>
						  <input type="text" name="mobile" id="input-phone">
						</div>
					</div>
					
					<input type="submit" value="Add Customer !" onclick="return(validateForm());" /> 
					
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