<html>
<head>
<title>Log In</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<style>
body{
	background-color: black;
}
#main{
	background-color:  white;
	position: relative;
	width:430px;
	height:130px;
}
.form{
	position:absolute;
	width:400px;
	height:150px;
	top:20px;
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
	float: inherit;
	left:25px;
	top:4px;
}
#submit{
	position:relative;
	left:100px;
	top:20px;
}
#sign_up{
	float:right;
	position: relative;
	width: 110px;
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
});
</script>
</head>

<body>
	<div id="main">
		
		<div class="form" id="sign_in_form">
			<?php
			echo form_open('blog/new_user');
			echo form_submit(array(	'class'	=>	'button',
									'id'	=>	'sign_up',
									'value'	=>	'Not a user yet?'
									));
			echo form_close('');
			?>
		<?php 
			echo form_open('blog/login');
			echo form_label('Username', 'username');
			echo form_input(array(	'name'	=>	'username',
									'class'	=>	'input',
									'id'	=>	'user_name'
									));
			echo "<br>";	
			echo form_label('Password', 'password');
			echo form_password(array(	'name'	=>	'password',
										'class'	=>	'input',
										'id'	=>	'password'
										));
			echo form_submit(array(	'class'	=>	'button',
									'id'	=>	'submit',
									'value'	=>	'Log in'
									));
			echo form_close('');
		?>
		</div>
	</div>
</body>
</html>