<?php
require "dbdetails.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$password=$_POST["password"];
$sql="SELECT PASSWORD FROM `admin`;";
$result=$conn->query($sql);
    // output data of each row
$row = $result->fetch_assoc(); 
		
if($row["PASSWORD"]==$password)
{
	session_start();
	$_SESSION['admin']=true;
	header('Location: administrator.php');				
}
else
{
	echo '<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Administrator Login </title>
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
		  
		  if( document.forms["af-form"]["password"].value == "" )
   {
     alert( "Please Enter password!" );
     document.getElementById("input-fname").focus() ;
     return false;
   }
		  
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
            </div><!--/ Codrops top bar -->	
			<header>
				<span></span>
				<h1>Login<span>!</span></h1>
				<!-- <nav class="codrops-demos">
					<a href="index.html">Color</a>
					<a class="current-demo" href="index2.html">Hide (scale)</a>
					<a href="index3.html">3D</a>
				</nav> -->
				<p></p>
				<p class="ie-note">D\'oh!</p>
			</header>
			
			<section class="af-wrapper">
	            <h3></h3>
		        
				<form class="af-form" method="post" action="./loginadmin.php" id="af-form" novalidate>     <!--      form values submited  hereeeeeeeeeeeeeeeeeeeeeeeeeeeeee -->
				
					<div class="af-outer af-required">
						<div class="af-inner">
							<label for="input-title">Enter Password</label>
							<input type="password" name="password" id="input-fname"><p>Wrong Password</p> 
						</div>
					</div>
				
					<input type="submit" value="Login !" onclick="return(validateForm());" /> 
					
				</form>
			</section>
        </div>
    </body>
</html>';
}
?>