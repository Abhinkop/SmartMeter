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
//echo $_GET["x"];
$sql = "INSERT INTO  `a2407222_testdb`.`aaaa` (
`x`
)
VALUES (
'".$_GET["x"]."'
);";

if ($conn->query($sql) === TRUE) {
    echo "recordinserted2414";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>