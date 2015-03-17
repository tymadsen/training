<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<style>
body{
	background-color: black;
}
#main{
	position: relative;
	background-color: white;
	width:400px;
	height:200px;
}
.form{
	position: relative;
	width: 400px;
	height: 150px;
	left: 75px;
	top: 30px;
}
a{
	position: relative;
	left:20px;
	top:5px;
	width:50px;
	height:10px;
}
label{
	display: inline-block;
	margin-top: 5px;}
.wrapper{
	position: relative;
	float: left;
	height: 125px;
}
.input{
	position: relative;
	display: inline;
	left: 15px;
	margin-top: 3px;}
#new_submit{
	position:absolute;
	left:85px;
	top:135px;
}
</style>
<script>
function init(){
	center_content();
	
	var error = '<?php echo $message; ?>';
	if(error != ""){
		alert(error);
	}
}

function center_content(){
	$('#main').css({
		top:(window.innerHeight-$('#main').height())/2+'px',
		left:(window.innerWidth-$('#main').width())/2+'px'
	});
}
$(document).ready(function(){
	init();
	//$('#new_submit').click(create_account);
});
</script>
</head>

<body>
	<div id="main">
		<div class="form" id="new_user_form">
			<div id="labels_wrapper" class="wrapper">
				<?php 
				echo form_label('First Name:', 'firstname') . "<br>";
				echo form_label('Last Name:', 'lastname') . "<br>";
				echo form_label('Username', 'username') . "<br>";
				echo form_label('Password', 'password') . "<br>";
				?>
			</div>
			<div id="input_wrapper" class="wrapper">
				<?php
				echo form_open('blog/create_account');
				echo form_input(array(	'name'	=>	'firstname',
										'class'	=>	'input',
										'id'	=>	'first_name'
										)) . "<br>";
				echo form_input(array(	'name'	=>	'lastname',
										'class'	=>	'input',
										'id'	=>	'last_name'
										)) . "<br>";
				echo form_input(array(	'name'	=>	'username',
										'class'	=>	'input',
										'id'	=>	'username'
										)) . "<br>";
				echo form_password(array(	'name'	=>	'password',
											'class'	=>	'input',
											'id'	=>	'password'
											)) . "<br>";
				echo form_submit(array(	'class'	=>	'button',
										'id'	=>	'new_submit',
										'value'	=>	'Sign up'
										)) . "<br>";
				echo form_close('');
				?>
			</div>
		</div>
	</div>
</body>
</html>