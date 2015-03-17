<?php

$con = mysqli_connect('localhost','root','root','Users');

if(mysqli_connect_errno($con)){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT * FROM user_responses WHERE user='$_POST[user_name]' AND quiz_id='$_POST[quiz_id]'";

$result = mysqli_query($con,$sql);
echo '<table id="completed_quizzes_table" style="width:400px;border:0px" border="1">';
echo '<tr style="position:absolute;left:0px;top:40px;background-color:white;z-index:200">';
echo '<th style="width:130px">Question #</th>';
echo '<th style="width:130px">Response</th>';
echo '<th style="width:130px">Time Taken</th>';
echo '</tr>';
//echo '<table id="quiz_table">';
while($row = mysqli_fetch_array($result)){
	echo '<tr><td style="text-align:center;width:132px;position:relative;top:25px">' . $row['question_id'] . '</td>';
	echo '<td style="text-align:center;width:130px;position:relative;top:25px">' . $row['response'] . '</td>';
	echo '<td style="text-align:center;width:130px;position:relative;top:25px">' . $row['time'] . '</td></tr>';
}
echo '</table>';
mysqli_close($con);

?>