<?php

$con = mysqli_connect('localhost','root','root','Users');

if(mysqli_connect_errno($con)){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT * FROM quiz_info WHERE user='$_POST[user_name]'";

$result = mysqli_query($con,$sql);
echo '<table id="quiz_table" style="width:100px;border:0px" border="1">';
echo '<tr style="position:absolute;left:0px;top:0px;background-color:white;z-index:200">';
echo '<th style="width:500px">Quiz #</th>';
echo '</tr>';
//echo '<table id="quiz_table">';
while($row = mysqli_fetch_array($result)){
	echo '<tr><td style="text-align:center;width:500px;position:relative;top:25px">' . $row['quiz_id'] . '</td></tr>';
}
echo '</table>';
mysqli_close($con);

?>