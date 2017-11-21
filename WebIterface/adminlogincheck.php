<?php
session_start();
if(isset($_SESSION['admin']) and ($_SESSION['admin']==true))
{
	echo 'loggedin';
}
else
{
header('Location: admin.html');
}
?>