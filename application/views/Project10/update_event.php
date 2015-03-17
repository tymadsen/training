<?php 

	$con = mysqli_connect('localhost','root','root','Users');
	if(mysqli_connect_errno())
		echo "Failed to connect to MySQL database: " . mysqli_connect_error();
	//echo $_POST[user_name] . " " . $_POST[month] . " " . $_POST[date] . " " . $_POST[title];
	$delimiter = "WHERE user_name='$_POST[user_name]' AND year='$_POST[year]' AND month='$_POST[month]' AND date='$_POST[date]' AND title='$_POST[title]' LIMIT 1";
	if($_POST[new_title] != "")
		$sql = "UPDATE user_events SET title='$_POST[new_title]' ".$delimiter;
	else
		$sql = "DELETE FROM user_events ".$delimiter;
	mysqli_query($con,$sql);
	if(mysqli_errno())
		echo "Error: " . mysqli_error($con);
	else
		echo '"'.$_POST[new_title].'"';
	
	mysqli_close($con);
?>