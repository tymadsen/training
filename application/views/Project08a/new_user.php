<html>
<head>

<?php
	$con = mysqli_connect('localhost','root','root','Users');
	if(mysqli_connect_errno($con)){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$fn = $_POST[first_name];
	$ln = $_POST[last_name];
	$b = $_POST[b_day];
	$un = $_POST[new_user_name];
	$p = $_POST[new_password];
	$error_message = "";
	if($fn == "" || $ln == "" || $b == "0000-00-00" || $un == "" || $p == ""){
		$error_message = "All fields are required.";
	}else{

		$sql = "INSERT INTO user_data (first_name, last_name, b_day, username, password) VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[b_day]','$_POST[new_user_name]','$_POST[new_password]')";
		if (!mysqli_query($con,$sql))
		  {
		  	$error_message = "Unable to add new user." . "Error: " . mysqli_error($con);
		  	//die('Error: ' . mysqli_error($con));
		  }
		  /*$photo_folder = $_POST[new_user_name] . "s_photos";
		  mkdir($photo_folder);
		  $no_img_location = $photo_folder . '/no_img.jpg'; 
		  copy('no_img.jpg',$no_img_location);
		  $sql2 = "INSERT INTO user_photos (username, password, photos) VALUES ('$_POST[new_user_name]','$_POST[new_password]','$no_img_location')";
		if(!mysqli_query($con,$sql2)){
			$error_message = "Unable to create photos storage." . "Error" . mysqli_error($con);
		}*/
	}
	mysqli_close();
?>

</head>
<body>
<a href="Login.html" id="login"></a>
<a href="NewUser.html" id="new_user"></a>
<script>
	
	//history.back();
	var message = '<?php echo $error_message; ?>';
	//alert(message);
	if(message == ""){
		document.getElementById('login').click();
		message = "New account created successfully";
	}else{
		document.getElementById('new_user').click();
	}
	alert(message);
</script>
</body>
</html>