
<style>

#neck{
	position: absolute;
	height: 120px;
}
.text{
	float:left;
	margin-top: 10px;
	margin-left: 20px;
	height: 100px;
	width:250px;
}
textarea{
	resize:none;
}
.label_div{
	float:left;
	margin-top: 10px;
	margin-left: 10px;
	height: 100px;
	width:100px;
}
.label{
	position: relative;
	left: 20px;
	width: 100px;
}
#top{
	height:50px;
}
#time{
	float:right;
	padding-right:20px;
	padding-top: 20px
}
#questions_wrapper{
	height:120px;
}
#frames_wrapper{
	height: 280px;
}
#question_frame{
	overflow: scroll;
	width: 717px;
	height:267px;
}
#question_frame_wrapper{
	left:170px;
	width:700px;
}
#quiz_frame{
	overflow: scroll;
	width:117px;
	height:267px;
}
#quiz_frame_wrapper{
	left:35px;
	width:100px;
}
.frame{
	position: absolute;
	overflow: hidden;
	top: 240px;
	height: 250px;
	background-color: white;
	border: 2px solid black;
	border-radius: 10px;
}
#problem{
	position: relative;
	top: 25px;
	left: 30px;
	height:275px;
	width:450px;
}
#quiz_id{
	position:relative;
	width:200px;
	left:300px;
	top: 20px;
	font-size: 30px;
}
#submit_btn{
	float:left;
	position: relative;
	top:20px;
	left:10px;
	width:60px;
	height:25px;
}
#submit{
	height: 50px;
	width: 100px;
	
}
#new_question_btn{
	position: relative;
	top:10px;
	left: 10px;
}
#new_quiz_btn{
	position: relative;
	top:10px;
	left: 10px;
}
#question_form{
	width:900px;
}

</style>
<script>
var user,quiz_id,question_id,time, site_url;
function init(){
	center_content();

	site_url = "<?php echo $base_url; ?>/";
	
	quiz_id = "1";
	time = "10";
	user_id = "<?php echo $user['user_id']; ?>"; 
	var new_user = "<?php echo $user['firstname'] . ' ' . $user['lastname']; ?>";
	// else if("<?php echo $info['time']; ?>" == ""){
	// 	//add quiz#1
	// 	var new_time = prompt("You have no quizzes.\nEnter the default time limit for quizzes.\n(Don't worry you can change quiz time limits individually.)","10");
	// 	if(new_time == null || new_time == undefined || new_time == "")
	// 		location = 'quiz_home.php';
	// 	else{
	// 		$('#time_set').val(new_time);
	// 		time = new_time;
	// 		set_time();
	// 	}
	// }
	
	update_quiz_table('<?php echo $info['quizzes']; ?>');
	update_question_table('<?php echo $info['questions']; ?>');
	question_id = "1";
	$('#quiz_label').text("Quiz #"+quiz_id);
	$('#question_label').text("Question #"+question_id+": ");
	$('#quiz_table td:first-child').first().click();
	$('#question_table td:first-child').first().click();
	update_time("<?php echo $info['time']; ?>");
	
}
function update_time(info){
	$('#time_allowed_label').text("Time Allowed: " + info);
	$('#time_set').hide();
	$('#set_time_btn').hide();
	$('#reset_time_btn').show();
}
function update_quiz_table(info){
	$('#quiz_frame').html(info);
	$('#quiz_table td:first-child').click(set_quiz);
	$('#quiz_table td:first-child').hover(function() {
		highlight($(this));
	},function() {
		un_highlight($(this));
	});
	}
function update_question_table(info){
	$('#question_frame').html(info);
	$('#question_table td:first-child').click(set_question);
	$('#question_table td:first-child').hover(function() {
		highlight($(this));
	},function() {
		un_highlight($(this));
	});
	
}
function set_quiz(){
	//$('#quiz_label').text("Quiz #"+num);
	//$('#quiz_set').hide();
	if(this.nodeName == 'TD'){
		$('#quiz_label').text("Quiz #"+this.innerHTML);
		quiz_id = this.innerHTML;
		// debugger;
		deselect($(this).parent().siblings());
		select($(this).parent());
		get_db_info(site_url, "get_questions", {
			id:quiz_id,
			user_id:user_id
		}, update_question_table);
		$('#question_table td:first-child').first().click();
		get_db_info(site_url, "get_time", {
			id:quiz_id,
			user_id:user_id
		}, update_time);
		$('#new_question_btn').click();
	}
}
function set_question(){
	if(this.nodeName == 'TD'){
		$('#question_label').text("Question #"+this.innerHTML+":");
		question_id = this.innerHTML;
		deselect($(this).parent().siblings());
		select($(this).parent());
		$('#question_text').val($(this).siblings().first().text());
		$('#answer_text').val($(this).siblings().last().text());
		/********show question in editing field*************/
	}
}
function reset_time(){
	//var time = $('#time_set').val();
	//var quiz = $('#quiz_set').val();
	//$('#quiz_label').text("Quiz #" + quiz_id);
	//$('#quiz_set').show();
	$('#time_allowed_label').text("Time Allowed:");
	$('#time_set').show();
	$('#set_time_btn').show();
	$('#reset_time_btn').hide();
	
	event.preventDefault();
}
function set_time(){

	time = $('#time_set').val();
	$('#time_allowed_label').text("Time Allowed: "+time);
	$('#time_set').hide();
	$('#set_time_btn').hide();
	$('#reset_time_btn').show();
	//set_time(time);
	//quiz_id = $('#quiz_set').val();
	//set_quiz(quiz_id,time);
	set_db_info(site_url, "set_time", {
		user_id:user_id,
		id:quiz_id,
		time_allowed:time
	}, function(){
		get_db_info(site_url, "get_quizzes", {
			id:quiz_id,
			user_id:user_id
		}, update_quiz_table);
	});
}
function new_quiz(){
	var q_max = $('#quiz_table td:first-child').length + 1;
	quiz_id = String(q_max);
	$('#quiz_label').text("Quiz #"+quiz_id);
	deselect($('#quiz_table tr'));

	set_time();
	
	$('#quiz_table td:first-child').last().click();
	$('#time_set').val("10");
	time = "10";

}
function new_question(){
	var q_max = $('#question_table td:first-child').length + 1;
	question_id = String(q_max);
	$('#question_label').text("Question #"+question_id+":");
	$('#question_text').val("Enter new question here");
	$('#answer_text').val("Enter answer here");
	deselect($('#question_table tr'));
}
function add_question(){
	var question_txt = $('#question_text').val();
	var answer_txt = $('#answer_text').val();
	set_db_info(site_url, "set_question", {
		id:quiz_id,
		question_id:question_id,
		question:question_txt,
		answer:answer_txt,
		user_id:user_id
	}, function(){
		get_db_info(site_url, "get_questions", {
			id:quiz_id,
			user_id:user_id
		}, update_question_table);
	});
    // $('#question_table td:first-child').eq(Number(question_id)-1).click();
	
}

$(document).ready(function(){
	$('#test').click(function(){
		//init();
	})

	$('#set_time_btn').click(set_time);
	$('#reset_time_btn').click(reset_time);
	$('#submit').click(add_question);
	//$('#question_ltable li').click(set_question);
	$('#new_question_btn').click(new_question);
	$('#new_quiz_btn').click(new_quiz);

	init();

	$('.button').hover(function(){
		highlight($(this));
	},function(){
		un_highlight($(this));
	});

});

</script>
<div style="float:left;padding-left:40px;padding-top:10px">
	<a style="text-decoration: none;" href="<? echo $base_url?>/quiz/home">
		<img src="<?php echo $site_url?>/images/back2.png" alt="Back" height="45" width="45">
	</a>
</div>

<div id="main">
	<div id="head">	
		
		<div id="time">
			<strong id="time_allowed_label">Time Allowed: <?php echo $info['time'];  ?></strong>
			<input id="time_set" value="10" size="3" maxlength="4">
			<span>minutes</span>
			<input type="button" id="set_time_btn" style="display:none" value="Set">
			<input type="button" id="reset_time_btn" value="Change">
		</div>
		<div id="quiz_id">
			<strong id="quiz_label">Quiz #</strong>
			<!--<input id="quiz_set" value="1" maxlength="4" size="2">-->
		</div>
	</div>
	<div id="body">
		<div id="questions_wrapper">
			<div class="label_div" id="q_label">
				<strong class="label" id="question_label">Question #1:</strong>
				<input type="button" class="button" id="new_question_btn" value="New Question">
				<input type="button" class="button" id="new_quiz_btn" value="New Quiz">
			</div>
			<div class="text" id="question">
				<textarea id="question_text" rows="7" cols="30" onclick="this.select()"></textarea>
			</div>
			<div class="label_div" id="a_label">
				<strong class="label">Answer:</strong>
			</div>
			<div class="text" id="answer">
				<textarea id="answer_text" rows="7" cols="30" onclick="this.select()"></textarea>
			</div>
			<div id="submit_btn">
				<input type="button" class="button" id="submit" value="Set Question">
			</div>
		</div>
		<div id="frames_wrapper">
			<div id="quiz_frame_wrapper"class="frame" >
				<div id="quiz_frame">
					<table id="quiz_table" style="width:100px;border:0px" border="1">
						<tr>
							<th>Quiz #</th>
						</tr>
					</table>
				</div>
			</div>
			<div id="question_frame_wrapper" class="frame">
				<div id="question_frame">
					<table id="question_table" style="width:700px;border:0px" border="1">
						<tr>
							<th style="width:80px">Question #</th>
							<th>Question</th>
							<th>Answer</th>
						</tr>
					</table>
				</div>
			</div>
		</div>	
	</div>
</div>