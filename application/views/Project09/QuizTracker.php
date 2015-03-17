<?php session_start(); ?>
<html>
<head>
<title>Log In</title>
<link rel="stylesheet" type="text/css" href="quiz_tracker.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="external_functions.js"></script>
<style>
body{
	background-color: black;
}
#main{
	position: relative;
	width:500px;
	height:200px;
}
.form{
	position:absolute;
	width:400px;
	height:150px;
	top:50px;
}
label{
	position: relative;
	left:20px;
	top:5px;
	width:50px;
	height:10px;
}
.input{
	position:relative;
	left:25px;
	top:5px;
}
#submit{
	position:relative;
	left:100px;
	top:5px;
}
#sign_up{
	float:right;
	position: relative;
	width: 110px;
	right:10px;
	top:5px;
}

</style>
<script>
function init(){
	center_content();
}
function login(){
	var user = $('#user_name').val();
	var pw = $('#password').val();
	$.post("log_in.php",{
		user_name:user,
		password:pw
	},function(data,status){
		// alert("Data: " + data + "\nStatus: " + status);
		//Do something...
		// if(data)
		// 	location = 
	});
}
function create_profile(){

}
$(document).ready(function(){
	init();
	$('#submit').click(login);
	$('#sign_up').click(create_profile);
});
</script>
</head>

<body>
	<div id="main">
		<div class="form" id="sign_in_form">
			<button id="sign_up"><span class="btn_txt">Not a user yet?</span>
			</button>
			<label for="user_name">Username:</label><input type="text" class="input" id="user_name"><br>
			<label for="password">Password:</label><input type="password" class="input" id="password"><br>
			<input type="button" class="button" id="submit" value="Log in">
		</div>
	</div>
</body>
</html>