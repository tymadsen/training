<?php session_start(); ?>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<?php

$con = mysqli_connect('localhost','root','root','Users');
if(mysqli_connect_errno($con)){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql = "SELECT * FROM user_data WHERE username='$_POST[user_name]' AND password='$_POST[password]'";
//echo $sql;
$result = mysqli_query($con,$sql);
$user_info = mysqli_fetch_array($result);
$first_name = $user_info[first_name];
$last_name = $user_info[last_name];
$birthday = $user_info[b_day];
$username = $user_info[username];
$password = $user_info[password];
$input_username = $_POST[user_name];
$input_password = $_POST[password];
$message = '';
if($username != $input_username || $password != $input_password){
		//document.getElementById('link').click();
		$location = 'Login.html';
		//history.back();
		$message = 'Incorrect username or password!';
	}else if($username == ""){
		//document.getElementById('link').click();
		$location = 'Login.html';
		$message = 'No such user exists';
	}else{
		//alert('hi!');
		echo "First Name: ".$user_info[first_name]
			."<br>Last Name: ".$user_info[last_name]
			."<br>Birthday: ".$user_info[b_day]
			."<br>Username: ".$user_info[username]
			."<br>Password: ".$_POST[password];
	}
//echo $user_info;
mysqli_close($con);
?>

</head>
</html>