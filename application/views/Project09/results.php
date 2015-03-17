
<style>

.label{
	position: relative;
	left: 5px;
	width: 100px;

}
.table_label{
	position:relative;
	left:10px;
	top:10px;
}
.top{
	height:40px;
}
.frame{
	position: relative;
	float: left;
	width: 400px;
	height:350px;
	margin-left: 30px;
	top: 15px;
	background-color: white;
	border: 2px solid black;
	border-radius: 10px;
}
.table{
	overflow: hidden;
	height:310px;
}
.table_data{
	overflow: scroll;
	width: 415px;
	height: 325px;
}
#user_id{
	float: right;
	margin-right:10px;
	margin-top:10px;
}
.list{
	text-align: center;
	width: 100px;
	height: 300px;
	float: left;
	margin-left: 10px;
}

</style>
<script>
var user,quiz_id;
function init(){
	center_content();
	site_url = "<?php echo $base_url; ?>/";
	user_id = "<?php echo $user['user_id']; ?>"; 
	
	user = "<?php echo $user['firstname'] . ' ' . $user['lastname']; ?>";
	$('#user').text(user);
	quiz_id = "0";
	
	$('#results_table td:first-child').click(get_quiz_responses);
	$('#results_table td:first-child').hover(function(){
		highlight($(this));
	},function(){
		un_highlight($(this));
	});
}

function get_quiz_responses(){

	if(this.nodeName == 'TD'){
		$('#quiz_label').text("Quiz #"+this.innerHTML);
		quiz_id = this.innerHTML;
		result_id = this.id;
		deselect($(this).parent().siblings());
		select($(this).parent());
		get_db_info(site_url, "get_responses", {
			quiz_result_id:result_id
		}, update_responses_table);
	}
}
function update_responses_table(info)
{
	$('#responses_table').html(info);
}
$(document).ready(function(){
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
		<a style="text-decoration: none;" href="<? echo $base_url?>/quiz/home">
			<div class="button" id="home">
				<img src="<? echo $site_url?>/images/back.png" alt="Back" height="50px" width="50px">
			</div>
		</a>
		<div id="user_id">
			<strong id="user">User</strong>
		</div>
	</div>
	<div id="body">
		<div id="left_frame" class="frame">
			<div class="top">
				<div id="score_label" class="table_label">
					<strong>Completed Quizzes:</strong>
				</div>
			</div>
			<div id="results_frame" class="table">
				<div id="results_table" class="table_data">
					<table id="completed_quizzes_table" style="width:400px;border:0px" border="1">
						<tr style="position:absolute;left:0px;top:40px;background-color:white;z-index:200">
							<th style="width:130px">Quiz #</th>
							<th style="width:130px">Score</th>
							<th style="width:130px">Date Taken</th>
						</tr>
						<?php foreach($results as $result): ?>
						<tr>
							<td style="text-align:center;width:130px;position:relative;top:25px" id="<?php echo $result['id']; ?>"><?php echo $result['quiz_id']; ?></td>
							<td style="text-align:center;width:130px;position:relative;top:25px"><?php echo $result['score'] . '%'; ?></td>
							<td style="text-align:center;width:130px;position:relative;top:25px"><?php echo $result['date']; ?></td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
		<div id="right_frame" class="frame">
			<div class="top">
				<div class="table_label">
					<strong id="quiz_label">Quiz #</strong>
				</div>
			</div>
			<div id="responses_frame" class="table">
				<div id="responses_table" class="table_data">
					
				</div>
			</div>
		</div>
	</div>
	<div id="foot">
	</div>
</div>