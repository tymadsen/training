
<script>
var quiz_id,question_id,result_id,user,time,score,quiz,question_timer,quiz_timer;
function init(){

	center_content();
	site_url = "<?php echo $base_url; ?>/";
	
	// quiz_id = "1";
	// time = "10";
	user_id = "<?php echo $user['user_id']; ?>"; 
	user = "<?php echo $user['firstname'] . ' ' . $user['lastname']; ?>";

	quiz_id = "0";//prompt("Enter which quiz you want to take.","1");
	question_id = 0;
	result_id = null;
	time = "12";//10";
	quiz_timer = new timer('#quiz_timer');
	question_timer = new timer('#question_timer');
	
	update_quiz_table('<?php echo $info['quizzes']; ?>');

}

function update_time(info){
	time = info;
	$('#time_allowed_label').text("Time Allowed: " + info + " minutes");
}
function update_quiz_table(info){
	$('#quiz_frame').html(info);
	$('#quiz_table').css("width","500px");
	$('#quiz_table td:first-child').click(set_quiz);
	$('#quiz_table td:first-child').hover(function() {
		highlight($(this));
	},function() {
		un_highlight($(this));
	});
}
function take_quiz(){
	if(quiz_id != "0" && quiz[0].length != 0){
		var data = {
			quiz_id:quiz_id,
			user_id:user_id
		};
		set_db_info(site_url, "submit_quiz", data, set_result_id);
		$('#question_frame').show();
		$('#take_quiz_div').hide();
		$('#home').hide();
		$('#quiz_time').show();
		score = 0;

		quiz_timer.reset();
		quiz_timer.start();
		next_question();
		
		$('#question_text').text(quiz[1][0].innerHTML);
		$('#question_id_text').text("Question #" + question_id);	
	}
}
function set_result_id($id){
	result_id = $id;
}
function set_quiz(){
	//$('#quiz_label').text("Quiz #"+num);
	//$('#quiz_set').hide();
	if(this.nodeName == 'TD'){
		$('#quiz_label').text("Quiz #"+this.innerHTML);
		quiz_id = this.innerHTML;
		get_db_info(site_url, "get_time", {
			id:quiz_id,
			user_id:user_id
		}, update_time);
		deselect($(this).parent().siblings());
		select($(this).parent());
		get_db_info(site_url, "get_questions", {
			id:quiz_id,
			user_id:user_id
		}, make_quiz);
		
	}
}
function make_quiz(info){
	$('#hidden_quiz_info').remove();
	$('<div id="hidden_quiz_info"></div>').html(info).hide().appendTo($('body'));
	var question_ids = $('#hidden_quiz_info td:nth-child(1)');
	var questions = $('#hidden_quiz_info td:nth-child(2)');
	var answers = $('#hidden_quiz_info td:nth-child(3)');
	quiz = [question_ids,questions,answers];
	$('#question_count_label').text("Number of Questions: "+quiz[0].length);
	//questions
}
function submit_answer(){
	//submit answer

	var output,response = $('#answer_text').val(),time_taken = question_timer.get_time();//change time_taken 

	set_db_info(site_url, "submit_answer", {
		quiz_result_id:result_id,
		question_id:question_id,
		time:time_taken,
		answer:response
	});
}
function submit_quiz(){
	//submit quiz
	var output, quiz_duration = quiz_timer.get_time();//not used
	var date = new Date();
	var d = date.getDate(),m = date.getMonth()+1,y = date.getFullYear();
	date = y+"-"+m+"-"+d;
	score = Math.round(score/$('#hidden_quiz_info td:first-child').length * 100);
	//calculate score
	//get date
	set_db_info(site_url, "submit_quiz", {
		id:result_id,
		user_id:user_id,
		quiz_id:quiz_id,
		score:score,
		date:date
	});
}
function next_question(){

	if(question_id != 0){
		question_timer.stop();
		submit_answer();
		var correct_answer = quiz[2][question_id-1].innerHTML.toLowerCase();
		if(correct_answer == $('#answer_text').val().toLowerCase())
			score++;
	}
	var q_count = quiz[0].length;
	if(q_count > question_id || question_id == 0){
		//reset_timer();
		$('#question_text').text(quiz[1][question_id].innerHTML);
		$('#question_id_text').text("Question #" + quiz[0][question_id].innerHTML);
		question_id++;
		question_timer.reset();
		question_timer.start();
	}else{
		end_quiz("Quiz Complete!");
	}
}
function end_quiz(alert_text){
	question_timer.stop();
	quiz_timer.stop();
	submit_quiz();
	$('#question_frame').hide();
	$('#take_quiz_div').show();
	$('#home').show();
	$('#hidden_quiz_info').remove();
	question_id = 0;
	quiz_timer.reset();
	$('#quiz_time').hide();
	alert(alert_text);
}

$(document).ready(function(){

	init();
	$('#take_quiz_btn').click(take_quiz);
	$('#submit').click(function(){
		//submit_answer();//Change this
		next_question();
	});

	$('#home').click(go_home);
	
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
		<a style="text-decoration: none;" href="<? echo $base_url?>/quiz/home">
			<div class="button" id="home">
				<img src="<? echo $site_url?>/images/back.png" alt="Back" height="50px" width="50px">
			</div>
		</a>
		<div id="quiz_id">
			<strong id="quiz_label">Quiz #</strong>
		</div>
		<div id="time_limit">
			<strong id="time_allowed_label">Time Allowed:</strong>
		</div>
		<div id="quiz_info">
			<strong id="question_count_label">Number of Questions: </strong>
		</div>
		<div id="quiz_time">
			<strong>Time:</strong>
			<span id="quiz_timer">00:00</span>
		</div>			
	</div>
	<div id="body">
		<div id="take_quiz_div">
			<div id="outer_frame" class="frame">
				<div id="quiz_frame"></div>
			</div>
			<button class="button" id="take_quiz_btn">Take Quiz</button>
		</div>
		<div id="question_frame" class="frame">
			<div id="top">
				<div id="question_id">
					<strong id="question_id_text">Question #1</strong>
				</div>
				<div id="question_time">
					<strong>Time:</strong>
					<span id="question_timer">00:00</span>
				</div>
			</div>
			<div id="problem">
				<div class="label_div" id="q_label">
					<h2 class="label">Question:</h2>
				</div>
				<div class="text" id="question">
					<p id="question_text">Question?</p>
				</div>
				<div class="label_div" id="a_label">
					<h2 class="label">Answer:</h2>
				</div>
				<div class="text" id="answer">
					<textarea id="answer_text" rows="7" cols="30">Answer.</textarea>
				</div>
				<div id="submit_btn">
					<button id="submit">Next</button>
				</div>
			</div>
		</div>
	</div>
	<div id="foot">
	</div>
</div>