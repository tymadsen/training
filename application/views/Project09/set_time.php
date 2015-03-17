<?php session_start(); ?>
<?php

	$con = mysqli_connect('localhost','root','root','Users');
	if(mysqli_connect_errno($con)){
		echo "Failed to connect to MySQL" . mysqli_connect_error();
	}
	$time = $_POST['time_set'];
	$quiz = $_POST['quiz_number'];
	$user = $_POST['user_name'];

	$sql = "SELECT * FROM quiz_info WHERE quiz_id=$quiz AND user='$user'";
	//echo "what you are entering:<br>time: " . $time . "<br>quiz: " . $quiz . "<br>user: " . $user . "<br>";
	$result = mysqli_query($con, $sql);
	//echo $sql . '<br>';
	//echo 'checkpoint<br>';
	//echo 'what you got: ';
	//echo $result . '<br>';
	//echo json_encode($result) . '<br>';
	$row = json_encode(mysqli_fetch_array($result));
	//echo 'whats in what you got: ' . $row . '<br>';

	$_SESSION['new_user'] = false;
	if($row != 'null'){
		//update
		echo "updating";
		$sql = "UPDATE quiz_info SET time_allowed=$time WHERE quiz_id=$quiz AND user='$user'";
	}else{
		//set data
		echo "setting";
		$sql = "INSERT INTO quiz_info (quiz_id, time_allowed, user) VALUES ('$quiz','$time','$user')";
	}

	echo "<br>" . mysqli_query($con, $sql);

	//*************now update the quiz builder******************//


	mysqli_close($con);


	// if nothing in database, then set it, otherwise update it





	//$sql = "INSERT INTO quiz_info (quiz_id,time_allowed,user) VALUES ()";


?>