function edit_quizzes(){
	location = 'quiz_builder.php';
}
function take_quiz(){
	location = 'take_quiz.php';
}
function get_results(){
	location = 'results.php';
}
function go_home(){
	location = "quiz_home.php";
}
var color;
var border;
function highlight(target){
	//state is true/false for on/ off hightlight
	border = target.css('border');
	color = target.css('background-color');
	target.css({backgroundColor:'#0000FF'});

	return target;
	/*target.css({
		backgroundColor:'#0000FF',
		borderColor:'#FFFFFF'
	});*/
}
function un_highlight(target){
	target.css({
		backgroundColor:color
		});
	return target;
}
function select(target){
	target.css({
		borderColor:'#FFFFFF'
		});
	return target;
}
function deselect(target){
	target.css({
		borderColor:'#000000'
		});
	return target;
}

function center_content(){
	$('#main').css({
		top:(window.innerHeight-$('#main').height())/2+'px',
		left:(window.innerWidth-$('#main').width())/2+'px'
	})
}
function log_off(){
	$.post("http://localhost/Training/Project10/log_out.php",{},function(data,status){
      //alert("Data: " + data + "\nStatus: " + status);
      if(data)
      	location = 'http://localhost/Training/Project10/login.html';
      else
      	alert(status);
    });
}
window.onresize = function(ev)
{
	center_content();
}