<?php session_start(); ?>
<?php

	$con = mysqli_connect('localhost','root','root','Users');
	if(mysqli_connect_errno($con)){
		echo "Failed to connect to MySQL" . mysqli_connect_error();
	}
	$quiz_id = $_POST[quiz_id];
	$question_id = $_POST[question_id];
	$question = $_POST[question];
	$answer = $_POST[answer];
	$user = $_POST[user_name];

	$sql = "SELECT * FROM quiz_questions WHERE quiz_id=$quiz_id AND question_id=$question_id AND user='$user'";
	echo "what you are entering:\nquiz_id: " . $quiz_id . "\nquestion_id: " . $question_id . "\nquestion: " . $question . "\nAnswer: " . $answer . "\nUser: " . $user . "\n";
	$result = mysqli_query($con, $sql);
	$row = json_encode(mysqli_fetch_array($result));


	if($row != 'null'){
		//update
		echo "<br>updating";
		$sql = "UPDATE quiz_questions SET question='$question', answer='$answer' WHERE quiz_id=$quiz_id AND question_id=$question_id AND user='$user'";
	}else{
		//set data
		echo "<br>setting";
		$sql = "INSERT INTO quiz_questions (quiz_id, question_id, question, answer, user) VALUES ('$quiz_id','$question_id','$question','$answer','$user')";
	}

	$db_state = mysqli_query($con, $sql);

	mysqli_close($con);

?>