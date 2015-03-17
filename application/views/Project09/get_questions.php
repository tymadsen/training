<?php

$con = mysqli_connect('localhost','root','root','Users');

if(mysqli_connect_errno($con)){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT * FROM quiz_questions WHERE quiz_id='$_POST[quiz_id]' AND user='$_POST[user_name]'";

$result = mysqli_query($con,$sql);

echo '<table id="question_table" style="width:700px;border:0px" border="1">';
echo '<tr style="position:absolute;left:0px;top:0px;background-color:white;z-index:200">';
echo '<th style="width:80px">Question #</th>';
echo '<th style="width:370px">Question</th>';
echo '<th style="width:276px">Answer</th></tr>';

while($row = mysqli_fetch_array($result)){
	echo '<tr style="position:relative;top:24px">';
	echo '<td style="cursor:pointer;text-align:center;position:relative;top:24px;width:84px">' . $row['question_id'] . '</td>';
	echo '<td style="position:relative;top:24px;width:370px">' . $row['question'] . '</td>';
	echo '<td style="position:relative;top:24px;width:276px">' . $row['answer'] . '</td>';
	echo '</tr>';
}

echo '</table>';
mysqli_close($con);

?>