<?php
	$con = mysqli_connect('localhost','root','root','Users');
	if(mysqli_connect_errno($con)){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$fn = $_POST[first_name];
	$ln = $_POST[last_name];
	$b = $_POST[b_day];
	$un = $_POST[new_user_name];
	$p = $_POST[new_password];
	$error_message = "";
	if($fn == "" || $ln == "" || $b == "0000-00-00" || $un == "" || $p == ""){
		$error_message = "All fields are required.";
		//$error_message = $fn . "," . $ln . "," .$b . "," . $un . "," . $p;
	}else{

		$sql = "INSERT INTO user_data (first_name, last_name, b_day, username, password) VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[b_day]','$_POST[new_user_name]','$_POST[new_password]')";

		if (!mysqli_query($con,$sql)){
		  	$error_message = "Unable to add new user." . "Error: " . mysqli_error($con);
		  	//die('Error: ' . mysqli_error($con));
		}else{
			$error_message = true;
		}
		
	}
	echo $error_message;
	mysqli_close();
?>