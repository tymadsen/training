<?php

$con = mysqli_connect('localhost','root','root','Users');

if(mysqli_connect_errno($con)){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT * FROM user_results WHERE user='$_POST[user_name]'";

$result = mysqli_query($con,$sql);
echo '<table id="completed_quizzes_table" style="width:400px;border:0px" border="1">';
echo '<tr style="position:absolute;left:0px;top:40px;background-color:white;z-index:200">';
echo '<th style="width:130px">Quiz #</th>';
echo '<th style="width:130px">Score</th>';
echo '<th style="width:130px">Date Taken</th>';
echo '</tr>';
//echo '<table id="quiz_table">';
while($row = mysqli_fetch_array($result)){
	echo '<tr><td style="text-align:center;width:130px;position:relative;top:25px">' . $row['quiz_id'] . '</td>';
	echo '<td style="text-align:center;width:130px;position:relative;top:25px">' . $row['score'] . '%' . '</td>';
	echo '<td style="text-align:center;width:130px;position:relative;top:25px">' . $row['date'] . '</td></tr>';
}
echo '</table>';
mysqli_close($con);

?>