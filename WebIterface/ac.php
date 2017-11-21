<?php
$servername = "mysql7.000webhost.com";
$username = "a2407222_abhin";
$password = "abhin123";
$dbname = "a2407222_testdb";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo $_GET["meterno"];
//echo $_GET["reading"];
$sql = "UPDATE `meterreadin` SET `watts` = '".$_GET["reading"]."' WHERE `meterreadin`.`meterno` = '".$_GET["meterno"]."';";
//echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "recordinserted2414";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>