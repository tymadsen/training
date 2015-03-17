<?php session_start(); ?>
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

	if($username == $input_username && $password == $input_password){
		
		if($username == "" || $password == ""){
			echo "No such user exixts.";	
			//echo "Incorrect username or password";
		}else{
			$_SESSION['user_name'] = $username;
			echo true;
		}
	}else{
		echo "Incorrect username or password.";
		//echo "Incorrect username or password";
	}
	mysqli_close($con);
?>