<?php
$servername = "mysql7.000webhost.com";
$username = "a2407222_abhin";
$password = "abhin123";
$dbname = "a2407222_testdb";

/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";
*/
$con=mysqli_connect($servername,$username,$password,$dbname);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT `watts`
FROM  `meterreadin` 
WHERE `meterno`='".$_GET['meterno']."'";

if ($result=mysqli_query($con,$sql))
  {
  while ($obj=mysqli_fetch_object($result))
    {
    printf("%f KWH\n",$obj->watts);
    }
  // Free result set
  mysqli_free_result($result);
}

mysqli_close($con);
?>