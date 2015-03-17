<?php

$con = mysqli_connect('localhost','root','root','Users');

if(mysqli_connect_errno($con)){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$limiter = "WHERE user='$_POST[user_name]' AND quiz_id='$_POST[quiz_id]'";

$sql = "SELECT * FROM user_results " . $limiter;

$result = mysqli_query($con,$sql);
$row = json_encode(mysqli_fetch_array($result));

echo "'$_POST[user_name]'\n'$_POST[quiz_id]'\n'$_POST[score]'\n'$_POST[date]'\n";

if($row != 'null'){
	//update...Should never be here!!!!!
	echo "updating...";
	$sql = "UPDATE user_results SET score='$_POST[score]',date='$_POST[date]' " . $limiter;
}else{
	//set
	echo "setting...";
	$values = "VALUES ('$_POST[quiz_id]','$_POST[score]','$_POST[date]','$_POST[user_name]')";
	$sql = "INSERT INTO user_results (quiz_id,score,date,user) " . $values;
}

echo mysqli_query($con,$sql);

mysqli_close($con);

?>
