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
	target.css({backgroundColor:'rgba(0,0,0,.1)'});

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
		borderColor:'rgb(255,20,20)'
		});
	return target;
}
function deselect(target){
	target.css({
		borderColor:'#000000'
		});
	return target;
}
function timer(timer_id){
	this.date = new Date();
	this.time = null;
	this.interval = null;
	this.id = timer_id;

	timer.prototype.get_time = function(){
		
		return this.time;
	}
	timer.prototype.reset = function(){
		this.time = 0;
		this.date = new Date();
		this.interval = null;
	}
	timer.prototype.stop = function(){
		clearInterval(this.interval);
	}
	timer.prototype.start = function(){
		var me = this;
		var seconds = 0;
		var minutes = 0;
		var time_taken_ms = 0;
		var d;
		this.interval = setInterval(function(){
			d = new Date();
			//alert(this.date);
			time_taken_ms = d.getTime()-me.date.getTime();
			seconds = Math.floor(time_taken_ms/1000);
			minutes = Math.floor(time_taken_ms/60000);
			me.time = Math.floor(time_taken_ms/10);
			
			if(seconds>59)
				seconds = seconds%60;
			if(seconds<10)
				seconds = "0"+seconds;
			if(minutes<10)
				minutes = "0"+minutes;

			$(me.id).text(minutes+":"+seconds);
			if(me.time >= Number(time*6000)){
				//stop quiz---time is up!!!!!
				end_quiz("Time is up! \n" + me.time);
			}
			if(me.time == Number(time*6000)-(5*6000))
				alert("You have 5 minutes left.");
			if(me.time == Number(time*6000)-(6000))
				alert("You have 1 minute left.");
		},100);
	}
}
function get_db_info(site, URL, $data, callback){
	//get time limits
	var output = "";
	$.ajax({
		url:site+'quiz/get_db_info/'+URL,  
		type:'post', 
		success:function(result,status,xhr){
			var quiz_message = "";
			if(status=="success")
				quiz_message = "External content loaded successfully!";
	    	if(status=="error")
	    		quiz_message = "Error: "+xhr.status+": "+xhr.statusText;
	    	else
	    		quiz_message = "Result: " + result + "\nStatus: " + status + "\nXHR: " + xhr.status + ": " + xhr.statusText;
	    	// alert(result);
	    	if(callback)
	    		callback(result);
	    	// return result;
		},
		data:$data,
		complete: function(xhr, status){
			// alert('You win!');
			// debugger;
		}
	});
}

function set_db_info(site, URL, $data, callback){
	//get time limits
	var output = "";
	$.ajax({
		url:site+'quiz/set_db_info/'+URL, 
		async:true, 
		type:'post', 
		success:function(result,status,xhr){
			var quiz_message = "";
			if(status=="success")
				quiz_message = "External content loaded successfully!";
	    	if(status=="error")
	    		quiz_message = "Error: "+xhr.status+": "+xhr.statusText;
	    	else
	    		quiz_message = "Result: " + result + "\nStatus: " + status + "\nXHR: " + xhr.status + ": " + xhr.statusText;
	    	// alert(quiz_message);
	    	// output = result;
	    	if(callback)
	    		callback(result);
		},
		data:$data
	});
	// return output;
}
function center_content(){
	$('#main').css({
		top:(window.innerHeight-$('#main').height())/2+'px',
		left:(window.innerWidth-$('#main').width())/2+'px'
	})
}
function log_off(){
	$.post("../project10/log_out.php",{},function(data,status){
      //alert("Data: " + data + "\nStatus: " + status);
      if(data)
      	location = '../Project10/login.html';
      else
      	alert(status);
    });
}

window.onresize = function(){
	center_content();
}