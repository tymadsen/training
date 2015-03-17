<?php

$con = mysqli_connect('localhost','root','root','Users');

if(mysqli_connect_errno($con)){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$limiter = "WHERE user='$_POST[user_name]' AND quiz_id='$_POST[quiz_id]' AND question_id='$_POST[question_id]'";

$sql = "SELECT * FROM user_responses " . $limiter;//WHERE user='$_POST[user_name]' AND quiz_id='$_POST[quiz_id]' AND question_id='$_POST[question_id]'";

$result = mysqli_query($con,$sql);
$row = json_encode(mysqli_fetch_array($result));

echo "'$_POST[user_name]'\n'$_POST[quiz_id]'\n'$_POST[question_id]'\n'$_POST[response]'\n'$_POST[time]'\n";

if($row != 'null'){
	//update...Should never be here!!!!!
	echo "updating...";
	$sql = "UPDATE user_responses SET response='$_POST[response]',time='$_POST[time]' " . $limiter;//WHERE user='$_POST[user_name]' AND quiz_id='$_POST[quiz_id]' AND question_id='$_POST[question_id]'";
}else{
	//set
	echo "setting...";
	$values = "VALUES ('$_POST[user_name]','$_POST[quiz_id]','$_POST[question_id]','$_POST[response]','$_POST[time]')";
	$sql = "INSERT INTO user_responses (user,quiz_id,question_id,response,time) " . $values;
}

echo mysqli_query($con,$sql);

mysqli_close($con);

?>
