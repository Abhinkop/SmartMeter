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
		<script type="text/javascript" src="js/modernizr.custom.04022.js"></script>
		<!--[if lt IE 8]>
			<style>
				.af-wrapper{display:none;}
				.ie-note{display:block;}
			</style>
		<![endif]-->
		
		<script>
		  function validateForm() {
		  
		  if( document.forms["af-form"]["fname"].value == "" )
   {
     alert( "Please provide your First Name!" );
     document.getElementById("input-fname").focus() ;
     return false;
   }
		  if( document.forms["af-form"]["lname"].value == "" )
   {
     alert( "Please provide your Last Name!" );
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
			
			
			<!-- if( document.forms["af-form"]["phonenumber"].value == ""  )
   {
     alert( "Please provide your phone number Name!" );
     document.getElementById("input-phone").focus() ;
     return false;
   }
			
			
			 -->
			
			}
			
			

		</script>
		
		
		
		
		
		
    </head>
    <body>
	
	<!-- <form action="lalalalal/la.html" name="Registration" onsubmit="return(validate());"> -->

	
	
	
	
        <div class="container">
			<!-- Codrops top bar -->
            <!-- <div class="codrops-top">
                <a href="http://tympanus.net/Tutorials/CSS3FluidParallaxSlideshow/">
                    <strong>&laquo; Previous Demo: </strong>Fluid CSS3 Slideshow with Parallax Effect
                </a>
                <span class="right">
                    <a href="http://tympanus.net/codrops/2012/05/02/enhance-required-form-fields-with-css3/">
                        <strong>Back to the Codrops Article</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div><!--/ Codrops top bar -->		 -->
			<header>
				<span></span>
				<h1>Add meter<span>!</span></h1>
				<!-- <nav class="codrops-demos">
					<a href="index.html">Color</a>
					<a class="current-demo" href="index2.html">Hide (scale)</a>
					<a href="index3.html">3D</a>
				</nav> -->
				<p>Fill in the details..</p>
				<p class="ie-note">D\'oh!</p>
			</header>
			
			<section class="af-wrapper">
	            
				<input id="af-showreq" class="af-show-input" type="checkbox" name="showreq" />
				
				<form class="af-form" method="post" action="addmeter.php" id="af-form" novalidate>     <!--      form values submited  hereeeeeeeeeeeeeeeeeeeeeeeeeeeeee -->
				
					<div class="af-outer af-required">
						<div class="af-inner">
							<label for="input-title">Customer id:</label>
							<input type="text" name="cid" id="input-fname">
						</div>
					</div>
				
					<div class="af-outer af-required">
						<div class="af-inner">
							<label for="input-name">Meter no.</label>
							<input type="text" name="mno" id="input-lname" >
						</div>
					</div>
					
					<!-- <div class="af-outer">
						<div class="af-inner">
						  <label for="input-catname">Your cat\'s name</label>
						  <input type="email" name="catsname" id="input-catname">
						</div>
					</div> -->
					
					<div class="af-outer">
						<div class="af-inner">
						  <label for="input-phone">No. Of Rooms</label>
						  <input type="email" name="nor" id="input-phone">
						</div>
					</div>
					
					<input type="submit" value="Sign Up !" onclick="validateForm();" /> 
					
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