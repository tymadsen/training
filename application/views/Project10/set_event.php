<?php 

	$con = mysqli_connect('localhost','root','root','Users');
	if(mysqli_connect_errno())
		echo "Failed to connect to MySQL database: " . mysqli_connect_error();
	//echo $_POST[user_name] . " " . $_POST[month] . " " . $_POST[date] . " " . $_POST[title];
	
	$sql = "INSERT INTO user_events (user_name,month,date,title,year) VALUES ('$_POST[user_name]','$_POST[month]','$_POST[date]',
		'$_POST[title]','$_POST[year]')";
	mysqli_query($con,$sql);
	if(mysqli_errno())
		echo "Error: " . mysqli_error($con);
	else{
		echo '['.'"'.$_POST[month].'"'.','.'"'.$_POST[date].'"'.','.'"'.$_POST[title].'"'.','.'"'.$_POST[year].'"'.']';
	}
	
	mysqli_close($con);
?>