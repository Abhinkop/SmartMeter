<?php
require "dbdetails.php";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST["cid"]) and isset($_POST["pass"]))
{
$cid=$_POST["cid"];
$pass=$_POST["pass"];
}
else{
header('Location: customerlogin.html');
exit();
}
$sql="SELECT password FROM `customer` WHERE `cid` = ".$cid."";
$result=$conn->query($sql);
if($result->num_rows>0)
{
$row = $result->fetch_assoc(); 
		
if($pass==$row["password"])
{
	session_start();
	$_SESSION["cid"]=$cid;
	$_SESSION["logedin"]=true;
	$sql="SELECT meterno FROM `meter` WHERE `ccid` = ".$cid."";
	$result=$conn->query($sql);
	//$row = $result->fetch_assoc(); 
	if($result->num_rows>0)
	{
		$row = $result->fetch_assoc(); 
		$_SESSION["meterno"]=$row["meterno"];
	}
	header('Location: meter1.php');
}
else
{
	echo '<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>Smart Meter</title>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="meter1/styles/layout.css" type="text/css">
<!--[if lt IE 9]><script src="meter1/scripts/html5shiv.js"></script><![endif]-->
<script>
		  function validate() {
		var val = document.getElementById("cid").value;
		
		if (/^\d+$/.test(val)) {
    // value is ok, use it
		} 
		else {
			alert("Enter Valid Customer ID");
			document.getElementById("cid").focus() ;
			return false;
		}
		  var val = document.getElementById("pass").value;
		if (val != "") {
    // value is ok, use it
		} 
		else {
			alert("Enter password");
			document.getElementById("pass").focus() ;
			return false;
		}
		
		}
</script>
</head>
<body>
<div class="wrapper row1">
  <header id="header" class="clear">
    <div id="hgroup">
      <h1><a href="#">Smart Meter</a></h1>
    </div>
    <nav>
      <ul></ul>
    </nav>
  </header>
</div>
<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- Slider -->
    <section id="slider" class="clear">
      <figure><figcaption>
          <h2>Login</h2>
          <form action="customerlogin.php" method="post">
			<label>Customer ID:<input  type="text" name="cid" id="cid" style="border-radius:5px; float:right;"/></label><br/>
			<label>Password:<input  type="password" name="pass" id="pass" style="border-radius:5px; float:right;"/><label><br/><br/>
			<input type="submit" value="Login" onclick="return(validate());" style="background-color:navy;border: none;float:right; color: white;padding: 10px 25px;text-align: center;text-decoration: none; display: inline-block; font-size: 16px;"/>
		  <p>Wrong Password</p>
		  </form>
		  </figcaption>
      </figure>
    </section>
    <!-- main content -->
    <div id="homepage">
      
    </div>
    <!-- / content body -->
  </div>
</div>
<!-- Footer -->
<div class="wrapper row3">
  <footer id="footer" class="clear">
    <p class="fl_left">Copyright &copy; 2012 - All Rights Reserved - <a href="#">Domain Name</a></p>
  </footer>
</div>
</body>
</html>
';
}
}
else
{
	echo '<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>Smart Meter</title>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="meter1/styles/layout.css" type="text/css">
<!--[if lt IE 9]><script src="meter1/scripts/html5shiv.js"></script><![endif]-->
<script>
		  function validate() {
		var val = document.getElementById("cid").value;
		
		if (/^\d+$/.test(val)) {
    // value is ok, use it
		} 
		else {
			alert("Enter Valid Customer ID");
			document.getElementById("cid").focus() ;
			return false;
		}
		  var val = document.getElementById("pass").value;
		if (val != "") {
    // value is ok, use it
		} 
		else {
			alert("Enter password");
			document.getElementById("pass").focus() ;
			return false;
		}
		
		}
</script>
</head>
<body>
<div class="wrapper row1">
  <header id="header" class="clear">
    <div id="hgroup">
      <h1><a href="#">Smart Meter</a></h1>
    </div>
    <nav>
      <ul></ul>
    </nav>
  </header>
</div>
<!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- Slider -->
    <section id="slider" class="clear">
      <figure><figcaption>
          <h2>Login</h2>
          <form action="customerlogin.php" method="post">
			<label>Customer ID:<input  type="text" name="cid" id="cid" style="border-radius:5px; float:right;"/></label><br/>
			<label>Password:<input  type="password" name="pass" id="pass" style="border-radius:5px; float:right;"/><label><br/><br/>
			<input type="submit" value="Login" onclick="return(validate());" style="background-color:navy;border: none;float:right; color: white;padding: 10px 25px;text-align: center;text-decoration: none; display: inline-block; font-size: 16px;"/>
		  <p>Wrong Customer ID</p>
		  </form>
		  </figcaption>
      </figure>
    </section>
    <!-- main content -->
    <div id="homepage">
      
    </div>
    <!-- / content body -->
  </div>
</div>
<!-- Footer -->
<div class="wrapper row3">
  <footer id="footer" class="clear">
    <p class="fl_left">Copyright &copy; 2012 - All Rights Reserved - <a href="#">Domain Name</a></p>
  </footer>
</div>
</body>
</html>
';
}

?>