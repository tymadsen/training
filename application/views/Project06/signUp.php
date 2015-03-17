<html>
<body>

  <?php
$con=mysqli_connect('localhost','root','root','students');
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$new_student="INSERT INTO student_forms (FirstName,LastName,Email,Phone) 
				VALUES ('$_POST[fName]','$_POST[lName]','$_POST[email]','$_POST[phone]')";

 if (!mysqli_query($con,$new_student))
  {
  die('Error: ' . mysqli_error($con));
  }
//echo "1 record added<br>";
//echo "new information added successfully";
$result = mysqli_query($con,"SELECT * FROM student_forms");

while($row = mysqli_fetch_array($result)){
	echo "<br>fName: " . $row['FirstName'] . "<br>lName: " . $row['LastName'] 
	. "<br>email: " . $row['Email'] . "<br>phone: " . $row['Phone'];	
}
mysqli_close($con);
?>
</body>
</html>