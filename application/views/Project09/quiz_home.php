
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

$(document).ready(function(){
	center_content();
	var user = '<?php echo $user["firstname"]; ?>';
	$('#user').text(user);
	//alert(user);
	//if(user == "")
		//location = 'QuizTracker.html';
	
	$('.button').hover(function(){
		highlight($(this));
	},function(){
		un_highlight($(this));
	});

	
});
</script>
<div style="float:left;padding-left:40px;padding-top:10px">
	<a style="text-decoration: none;" href="<? echo $base_url?>/training/last">
		<img src="<?php echo $site_url?>/images/back2.png" alt="Back" height="45" width="45">
	</a>
</div>

<div id="container">
	<?php 
		echo form_open('/quiz/quizbuilder');
		echo form_submit('submit', 'Edit Quizzes', 'class="button big" id="photos"');
		echo form_close();

		echo form_open('/quiz/take_quiz');
		echo form_submit('submit', 'Take Quizzes', 'class="button big" id="quizzes"');
		echo form_close();

		echo form_open('/quiz/quiz_results');
		echo form_submit('submit', 'View My Results', 'class="button big" id="calendar"');
		echo form_close();
	?>
</div>
<div id="foot">
</div>