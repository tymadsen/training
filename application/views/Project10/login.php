<style>

#main{
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
$(document).ready(function(){
	center_content();
});
</script>

<div id="main">
	<div class="form" id="sign_in_form">
		<?php 
			echo form_open('/training/signup');
			echo form_submit('submit', 'Not a user yet?', 'class="button" id="sign_up"');
			echo form_close();
		// <button id="sign_up" class="button"><span class="btn_txt">Not a user yet?</span>
		// </button>
		// <?php 

			echo form_open('training/login');
			echo form_label('Username', 'user_name');
			echo form_input(array('name' => 'username', 'id' => 'user_name', 'class' => 'input'));
			echo '<br>';
			echo form_label('Password', 'password');
			echo form_password(array('name' => 'password', 'class' => 'input', 'id' => 'password'));
			echo '<br>';
			echo form_submit('submit', 'Sign in', 'class="button" id="submit"');
			echo form_close();

		?>
	</div>
</div>