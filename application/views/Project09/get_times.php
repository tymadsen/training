<?php

$con = mysqli_connect('localhost','root','root','Users');

if(mysqli_connect_errno($con)){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT * FROM quiz_info WHERE quiz_id='$_POST[quiz_id]' AND user='$_POST[user_name]'";

$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)){
	echo $row['time_allowed'];
}

mysqli_close($con);

?>