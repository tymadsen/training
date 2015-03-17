<?php session_start(); ?>
<?php
$_SESSION['user_name'] = "";
if($_SESSION['user_name'] == "")
	echo true;
else
	echo false;
?>