<?php
session_start();
if(isset($_SESSION['admin']) and ($_SESSION['admin']==true))
{
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
        <title>Administrator</title>
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
				</tr>';
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

echo '
				</table>
				</p>
			</section>
		</div>
    </body>
</html>';
$conn->close();
}
else
{
header('Location: admin.html');
}
?>