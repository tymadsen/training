<style type="text/css">
	
	.big
	{
		height: 15vh;
		width: 50vw;
		font-size: 3em;
		margin: 2vh 15vw;
		cursor: pointer;
	}

	#container
	{
		height:80%;
		width:80%;
		background: rgb(180, 198, 219);
		margin:10% 10%; 
	}
</style>

<script>
$(function(){
	center_content();
});
</script>

<div id="container">
	<?php 
		echo form_open('/training/photoviewer');
		echo form_submit('submit', 'Photos', 'class="button big" id="photos"');
		echo form_close();

		echo form_open('/quiz/home');
		echo form_submit('submit', 'Quiz Home', 'class="button big" id="quizzes"');
		echo form_close();

		echo form_open('/training/calendar');
		echo form_submit('submit', 'Calendar', 'class="button big" id="calendar"');
		echo form_close();
	?>
</div>