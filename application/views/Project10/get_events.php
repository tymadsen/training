<?php 

$con = mysqli_connect('localhost','root','root','Users');
	if(mysqli_connect_errno())
		echo "Failed to connect to MySQL database: " . mysqli_connect_error();
	//echo $_POST[user_name] . " " . $_POST[month] . " " . $_POST[date] . " " . $_POST[title];
	
	$sql = "SELECT * FROM user_events WHERE user_name='$_POST[user_name]'";
	$result = mysqli_query($con,$sql);
	$count = 0;
	echo '[';
	while($row = mysqli_fetch_array($result)){
		$month = $row['month'];
		$date = $row['date'];
		$title = $row['title'];
		$year = $row['year'];
		if($count != 0)
			echo ',';
		echo '['.'"'.$month.'"'.','.'"'.$date.'"'.','.'"'.$title.'"'.','.'"'.$year.'"'.']';
		$count++;
	}
	echo ']';
	mysqli_close($con);
?>