<?php
require "dbdetails.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql="SELECT COSTPERUNIT FROM `cost`;";
$result=$conn->query($sql);
    // output data of each row
$row = $result->fetch_assoc(); 
		
$cpu=$row["COSTPERUNIT"];

$sql='SELECT `cid`, `name`, `mobile`, `email`, `meterno`,`reading` FROM `customer`,`meter` WHERE cid=ccid;';
$result = $conn->query($sql);
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
				<h1>View all Meters<span>!</span></h1>
				<!-- <nav class="codrops-demos">
					<a href="index.html">Color</a>
					<a class="current-demo" href="index2.html">Hide (scale)</a>
					<a href="index3.html">3D</a>
				</nav> -->
				<p></p>
				<p class="ie-note">D\'oh!</p>
			</header>
			
			<section class="af-wrapper">
	            <h3>Details Of meters and Customers</h3>
		        
				
				<p><table>
				<tr style="border-top: 1px solid #C1C3D1; border-bottom-: 1px solid #C1C3D1; color:#666B85;  font-size:16px;  font-weight:normal;  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);">
				<th style="  color:#D5DDE5; background:#1b1e24;border-bottom:4px solid #9ea7af;  border-right: 1px solid #343a45;  font-size:16px;  font-weight: 100;  padding:5px;  text-align:center;  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);  vertical-align:middle;;"><u>Customer Id</u></th>
				<th style="  color:#D5DDE5; background:#1b1e24;border-bottom:4px solid #9ea7af;  border-right: 1px solid #343a45;  font-size:16px;  font-weight: 100;  padding:5px;  text-align:center;  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);  vertical-align:middle;"><u>Name</u></th>
				<th style="  color:#D5DDE5; background:#1b1e24;border-bottom:4px solid #9ea7af;  border-right: 1px solid #343a45;  font-size:16px;  font-weight: 100;  padding:5px;  text-align:center;  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);  vertical-align:middle;"><u>Mobile No.</u></th>
				<th style="  color:#D5DDE5; background:#1b1e24;border-bottom:4px solid #9ea7af;  border-right: 1px solid #343a45;  font-size:16px;  font-weight: 100;  padding:5px;  text-align:center;  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);  vertical-align:middle;"><u>E-mail</u></th>
				<th style="  color:#D5DDE5; background:#1b1e24;border-bottom:4px solid #9ea7af;  border-right: 1px solid #343a45;  font-size:16px;  font-weight: 100;  padding:5px;  text-align:center;  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);  vertical-align:middle;"><u>Meter No.</u></th>
				<th style="  color:#D5DDE5; background:#1b1e24;border-bottom:4px solid #9ea7af;  border-right: 1px solid #343a45;  font-size:16px;  font-weight: 100;  padding:5px;  text-align:center;  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);  vertical-align:middle;"><u>Power Readings in kWH</u></th>
				<th style="  color:#D5DDE5; background:#1b1e24;border-bottom:4px solid #9ea7af;  border-right: 1px solid #343a45;  font-size:16px;  font-weight: 100;  padding:5px;  text-align:center;  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);  vertical-align:middle;"><u>Bill in Rs.</u></th>
				</tr>
';
if ($result->num_rows > 0) 
{
    // output data of each row
		while($row = $result->fetch_assoc()) 
		{
			echo '<tr style="border-top: 1px solid #C1C3D1; border-bottom-: 1px solid #C1C3D1; color:#666B85;  font-size:16px;  font-weight:normal;  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);">
				<td style="background:#FFFFFF;  padding:4px;  text-align:center;  vertical-align:middle;  font-weight:300;  font-size:15px;  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);  border-right: 1px solid #C1C3D1;border-left: 1px solid #C1C3D1;border-bottom: 1px solid #C1C3D1;">'.$row["cid"].'</td>
				<td style="background:#FFFFFF;  padding:4px;  text-align:center;  vertical-align:middle;  font-weight:300;  font-size:15px;  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);  border-right: 1px solid #C1C3D1;border-bottom: 1px solid #C1C3D1;">'.$row["name"].'</td>
				<td style="background:#FFFFFF;  padding:4px;  text-align:center;  vertical-align:middle;  font-weight:300;  font-size:15px;  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);  border-right: 1px solid #C1C3D1;border-bottom: 1px solid #C1C3D1;">'.$row["mobile"].'</td>
				<td style="background:#FFFFFF;  padding:4px;  text-align:center;  vertical-align:middle;  font-weight:300;  font-size:15px;  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);  border-right: 1px solid #C1C3D1;border-bottom: 1px solid #C1C3D1;">'.$row["email"].'</td>
				<td style="background:#FFFFFF;  padding:4px;  text-align:center;  vertical-align:middle;  font-weight:300;  font-size:15px;  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);  border-right: 1px solid #C1C3D1;border-bottom: 1px solid #C1C3D1;">'.$row["meterno"].'</td>
				<td style="background:#FFFFFF;  padding:4px;  text-align:center;  vertical-align:middle;  font-weight:300;  font-size:15px;  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);  border-right: 1px solid #C1C3D1;border-bottom: 1px solid #C1C3D1;">'.$row["reading"].'</td>
				<td style="background:#FFFFFF;  padding:4px;  text-align:center;  vertical-align:middle;  font-weight:300;  font-size:15px;  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);  border-right: 1px solid #C1C3D1;border-bottom: 1px solid #C1C3D1;">'.($row["reading"]*$cpu).'</td>
				</tr>
				';
		}
}

echo '				</table>
				</p>
			</section>
        </div>
    </body>
</html>';
$conn->close();
?>