<style>
	#main{
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
	$(document).ready(function(){
	
		center_content();
	});
</script>
<div id="main">
	<div class="form" id="new_user_form">
		<div id="labels_wrapper" class="wrapper">
			<?php
				echo form_open('training/signup');
				echo form_label('First Name', 'firstname');
				echo '<br>';
				echo form_label('Last Name', 'lastname');
				echo '<br>';
				echo form_label('Username', 'username');
				echo '<br>';
				echo form_label('Password', 'password');
				echo '<br>';
			?>
		</div>
		<div id="input_wrapper" class="wrapper">

			<?php 
				echo form_input(array('name' => 'firstname', 'id' => 'first_name', 'class' => 'input'));
				echo '<br>';	
				echo form_input(array('name' => 'lastname', 'id' => 'last_name', 'class' => 'input'));
				echo '<br>';
				echo form_input(array('name' => 'username', 'id' => 'new_user_name', 'class' => 'input'));
				echo '<br>';
				echo form_password(array('name' => 'password', 'id' => 'new_password', 'class' => 'input'));
				echo '<br>';
				echo form_submit('submit', 'Sign up', 'class="button" id="new_submit"');
				echo form_close();
			?>
		</div>
	</div>
</div>