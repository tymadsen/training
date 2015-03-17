
<style>
body{
	background-color: black;
	-webkit-user-select:none;
	-moz-user-select:none;
	-ms-user-select:none;
}
#main{
	background-color: white;
	position: absolute;
	width: 960px;
	height:	600px;
}
#head{
	height:70px;
}
#body{
	height:530px;
}
#calendar{
	border-top:1px solid gray;
	border-left:1px solid gray;
	position: relative;
	left:11px;
	top:8px;
	width:917px; 
	height:504px;
}
#month_label_container{
	position: relative;
	float: left;
	top: 10px;
	left: 10px;
	width: 300px;
	height: 50px;
}
#month_label{
	font: 26px arial,sans-serif;
}
#navigate_button_container{
	position: relative;
	float: right;
	height: 22px;
	width: 112px;
	top: 30px;
	right: 12px;
}
#navigate_button{
	background: linear-gradient(to bottom, rgba(0,0,0,0)50%, rgba(0,0,0,.10));
	overflow: hidden;
	text-align: center;
	height: 20px;
	border: 1px solid gray;
	border-radius: 5px
}
.btn{
	position: relative;
	float: left;
	height:20px;
}
#back{
	width: 25px;
}
#today{
	width:60px;
}
#forward{
	width:25px;
}
#today_text{
	position: relative;
	top:2px;
	width:60px;
	font: 12px arial,sans-serif;
}
.highlight{
	background-color: rgba(90,165,255,.25);
}
.calendar_item{
	position: relative;
	overflow: hidden;
	top: 20px;
	margin-top: 2px;
	left: 2px;
	width: 124px;
	height:15px;
	border-radius: 10px;
	text-align: left;
	color:black;
	font:13px arial,sans-serif;
}
.holiday{
	background-color: rgba(90,255,165,.25);
	text-align: center;
	position: relative;
	top:40px;
	/*border: 1px solid rgba(90,255,165,.5);*/
}
.holiday_text{
	color:rgba(0,0,0,.25);
	position: relative;
	top:40px;
}
.event{
	background-color: rgba(255,90,165,.25);
	border: 1px solid rgba(255,90,165,.5);
}
.event_text{
	color:rgba(0,0,0,.65);
	position: relative;
	left:10px;
}
.line_div{
	position: relative;
	width: 1px;
	top:2px;
	background-color: gray;
	height:16px;
}
#left{
	float: left;
}
#right{
	float:right;
}
.clicked{
	background: linear-gradient(to bottom, rgba(0,0,0,.20), rgba(0,0,0,0) 50%);
}
.extended_line_div{
	top:0px;
	height:20px;
}
#test{
	/*position: relative;
	float: left;
	border: 2px solid black;
	width: 50px;
	height:50px;*/
}
</style>
<script>
var current_index,holidays,prev_days,user,site_url,user_id;
function init(){
	site_url = "<?php echo $base_url; ?>/";
	user_id = "<?php echo $user['user_id']; ?>"; 
	user = "<?php echo $user['firstname'] . ' ' . $user['lastname']; ?>";
	load_holidays();
	current_index = 0;
	$('#month_label').text(get_month()+" "+ get_year());

	load_calendar(current_index);
	set_holidays();
	access_database("get_events",{user_id:user_id},load_events);

	var left_arrow = new arrow(false);
	var right_arrow = new arrow(true);
	$('#back').append(left_arrow);
	$('#forward').append(right_arrow);

	
}
function arrow(flag){
	var canvas = $('<canvas></canvas>');

	var ctx = canvas.get(0).getContext('2d');
	ctx.strokeStyle = '#004488';
	//ctx.begin();
	ctx.canvas.height = 20;
	ctx.canvas.width = 20;
	//ctx.scale(2);
	if(flag){
		
		ctx.translate(20,20);
		ctx.rotate(3.14);
	}

	ctx.beginPath();
	ctx.moveTo(6,10);

	ctx.lineTo(14,6);
	ctx.lineTo(14,14);
	ctx.fill();
	ctx.closePath();
	return canvas;

}
//index: the relative index to current month
function load_calendar(index){

	//clear current calendar
	$('#calendar').empty();
	var temp_date = new Date(),today = new Date();
	temp_date.setMonth(temp_date.getMonth()+index);
	today.setMonth(today.getMonth()+index);
	var indexof_last_mo = today.getMonth()-1;
	var indexof_next_mo = today.getMonth()+1;
	temp_date.setMonth(indexof_last_mo);
	var lm_info = get_month_info(temp_date);
	temp_date.setMonth(indexof_next_mo);
	var nm_info = get_month_info(temp_date);
	
	//var last_mo = new Date(),next_mo = today;
	//last_mo.setMonth(indexof_last_mo);
	//next_mo.setMonth(index0f_next_mo);

	var this_month_info = get_month_info(today);
	temp_date.setDate(1);
	var indexof_first_day = temp_date.getDay();
	var days_in;

	var cells = this_month_info[0]+this_month_info[1] > 35 ? 42 : 35;
	var data = [lm_info,this_month_info,nm_info];


	load_days(cells,data);
	//get_month_info();
}
function load_days(num,cal_data){

	cell_width = Math.floor(($('#calendar').width()-7)/7);
	cell_height = Math.floor(($('#calendar').height()-4)/(num/7));
	var label = "",day = "";
	var start = cal_data[1][0];
	prev_days = start;
	var date = new Date();
	var today_cell_index = date.getDate()+start-1;
	date.setDate(date.getDate() - date.getDay());
	var dt = new Date();

	for(var i = 0;i<num;i++){
		if(i<7){
			dt.setDate(date.getDate()+i);
			label = dt.toString().slice(0,4);
		}else{
			label = "";
		}
		if(i < start)
			day = cal_data[0][1]-start+i+1;
		else if(i < start+cal_data[1][1])
			day = (i+1) - start;
		else
			day = (i+1) - (start+cal_data[1][1]);
		var cell = $('<div class="cell"></div>').appendTo($('#calendar')).css({
			height:cell_height+'px',width:cell_width+'px',borderRight:'1px solid gray',borderBottom:'1px solid gray',position:'relative',float:'left',left:'-1px',top:'-1px',overflow:'hidden'
		});
		var cell_label = $('<span class="cell_label">'+label+day+'</span>').css({
			position:'absolute',top:'5px',right:'5px',color:'gray',font:'13px arial,sans-serif'
		}).appendTo(cell);
		if(i == today_cell_index && current_index == 0){
			if(i>6)
				cell_label.prepend(get_month() + " ")
			cell.addClass('highlight').prepend($('<span>Today</span>').css({
				position:'absolute',top:'5px',left:'5px',color:'blue',font:'13px arial,sans-serif',fontWeight:'bold'
			}));
			cell_label.css({
				color:'blue'
			});

		}
		cell.dblclick(create_event);
		//cell.click(test);
	}
}
function test(){
	var date = Number($(this).find(".cell_label").last().text().split(" ").pop());
	if(date > $(this).prevAll().length+1)
		alert("last Month");
	if($(this).prevAll().length > 21 && date<6)
		alert("next Month");
}
function create_event(){
	//work here
	//do a check for the date plus previous days of the month for a match on the index of the cell

	var year = get_year();
	var month = get_month();
	var date = Number($(this).find(".cell_label").last().text().split(" ").pop());
	if(date > $(this).prevAll().length+1){
		month = get_month(-1);
		if(month == "December")
			year--;
	}
	else if($(this).prevAll().length > 21 && date<6){
		month = get_month(1);
		if(month == "January")
			year++;
	}

	var event_text = prompt('Add a new event for ' + date + " " + month + " " + year);
	if(event_text!=null && event_text != ""){
		access_database(
			"set_event",
			{user_id:user_id,year:year,month:month,date:date,title:event_text}, 
			function(data){
				set_event(data,false);
			});
	}

}
function access_database(URL, data, callback){//URL,year,month,date,text,update){

	var results;/*year == undefined || year == null
		||month == undefined || month == null
		||date == undefined || date == null
		||text == undefined || text == null
		||update == undefined || update == null*/
	
	// if(params.length == 1){
	// 	data = {user_id:user_id};
	// }else
	// 	data = {
	// 			user_id:user_id,
	// 			year:params[1],
	// 			month:params[2],
	// 			date:params[3],
	// 			title:params[4],
	// 			new_title:params[5]	
	// 		};
	$.ajax({
		url:site_url+"training/calendar_db/"+URL,
		type:"post",
		success:function(result,status,xhr){
			var message = "";
			if(status=="success")
				message = "External content loaded successfully!";
	    	if(status=="error")
	    		message = "Error: "+xhr.status+": "+xhr.statusText;
	    	else
	    		message += "\nResult: " + result + "\nStatus: " + status + "\nXHR: " + xhr.status + ": " + xhr.statusText;
	    	//alert("Server Response: \n"+ message);
			if(callback)
				callback(eval(result));
			// results = eval(result);
		},data:data});
	// return results;
}
function get_month_info(date){
	
	date.setDate(1);
	var first_day = date.getDate();
	var fd_index = date.getDay();
	date.setMonth(date.getMonth()+1);
	date.setDate(0);
	var num_days = date.getDate();
	var ld_index = date.getDay();
	return [fd_index,num_days];
}
function load_events(events_data){

	for(var i = 0; i < events_data.length;i++){
		var event_data = events_data[i];
		set_event(event_data,false);
	}
}
function edit_event(){
	var text = $(this).text();
	var year = get_year();
	var month = get_month();
	var date = Number($(this).parent().find(".cell_label").last().text().split(" ").pop());
	var event_id = $(this)[0].id;
	if(date > $(this).parent().prevAll().length+1){
		month = get_month(-1);
		if(month == "December")
			year--;
	}
	else if($(this).parent().prevAll().length > 21 && date<6){
		month = get_month(1);
		if(month == "January")
			year++;
	}

	var new_text = prompt('Edit event for ' + date + " " + month + " " + year + "\nOr make it blank and press enter to delete this event.",text);
	if(new_text!=""){
		var data = access_database("update_event",{id:event_id,user_id:user_id,year:year,month:month,date:date,title:text,new_title:new_text});
		$(this).children().first().text(data);
	}
	else
	{
		access_database("delete_event",{id:event_id});
		$(this).remove();
	}
}
function set_event(event_data,holiday){
	var id = event_data[0];
	var mo = event_data[1];
	var date = event_data[2];
	var title = event_data[3];
	var yr = event_data[4] == undefined ? get_year() : event_data[4];
	var cell_index,mo_index,off_calendar;
	if(mo == get_month())
		mo_index = 1;
	else if(mo == get_month(-1))
		mo_index = 0;
	else if(mo == get_month(1))
		mo_index = 2;
	
	//var temp = new Date();
	var temp = get_current_month();
	temp.setMonth(temp.getMonth() + (mo_index-1));
	temp.setDate(1);
	var previous_days = temp.getDay();
	temp.setMonth(get_current_month().getMonth()+mo_index);
	temp.setDate(0);
	var days_in_month = temp.getDate();

	if(date.split(" ").length > 1){
		var multiple = Number(date.split(" ")[0]);
		var index = Number(date.split(" ")[1]);
		date = previous_days > index ? index+(7*multiple) : index+(7*(multiple-1));
		date++;
		date -= previous_days;
	}else{
		date = Number(date);
	}
	cell_index = date + (prev_days - 1);

	if(mo != get_month()){
		//previous month events
		if(mo == get_month(-1)){
			cell_index = prev_days-((days_in_month-date)+1);

		}else if(mo == get_month(1)){//next month events
			var d = new Date();
			d.setMonth(get_current_month().getMonth()+1);
			d.setDate(0);
			var offset = d.getDate()-1;
			cell_index = prev_days + date + offset;
		}else{
			cell_index = -1;
		}
	}

	var event_css,cell_css,to_add;
	if(holiday){
		event_css = '';
		cell_css = 'holiday';
		to_add = $('<span>'+title+'</span>').addClass('holiday_text');
	}else{
		if(yr != get_year())
			cell_index = -1;
		event_css = 'event calendar_item';
		cell_css = '';
		to_add = $('<div id="'+id+'"></div>').append($('<span>'+title+'</span>').addClass('event_text')).addClass(event_css).click(edit_event);
	}
	if(cell_index > 0 && cell_index < $('.cell').length){

		var cell = $('.cell').eq(cell_index);
		cell.addClass(cell_css).append(to_add);
	}
}

function load_holidays(){
	holidays = [
	[["NULL","January","1","New Year's Day"],["NULL","January","4 1","Martin Luther King Day"]],
	[["NULL","February","14","Valentine's Day"],["NULL","February","3 1","Presidents Day"]],
	[["NULL","March","17","St. Patrick's Day"]],
	[["NULL","April","1","April Fool's Day"],["NULL","April","22","Earth Day"]],
	[["NULL","May","2 0","Mother's Day"],["NULL","May","4 1","Memorial Day"]],
	[["NULL","June","14","Flag Day"],["NULL","June","3 0","Father's Day"]],
	[["NULL","July","4","Independence Day"]],
	[/*"NULL",August -- No holidays*/],
	[["NULL","September","1 1","Labor Day"]],
	[["NULL","October","2 1","Columbus Day"],["NULL","October","31","Halloween"]],
	[["NULL","November","4 4","Thanksgiving"]],
	[["NULL","December","25","Christmas Day"],["NULL","December","31","New Year's Eve"]]
	];

}
function set_holidays(){
	var holiday_info,index;
	for(var x = 0;x<3;x++){
		index = x+(get_current_month().getMonth()-1);
		if(index>11)
			index-=12;
		else if(index<0)
			index+=12;

		holiday_info = holidays[index];
		for(var i=0;i<holiday_info.length;i++){
			set_event(holiday_info[i],true);
		}
	}
}
function next(){
	current_index++;
	refresh();
}
function previous(){
	current_index--;
	refresh();
}
function refresh(){
	$('#month_label').text(get_month() + " " + get_year());
	load_calendar(current_index);
	set_holidays();
	access_database("get_events",{user_id:user_id}, load_events);
}
function get_month(offset){
	if(offset == null || offset == undefined)
		offset = 0;
	var index = get_current_month().getMonth()+offset;
	if(index>11)
			index-=12;
		else if(index<0)
			index+=12;
	var month = "";
	switch(index){
		case 0: month = "January";
		break;
		case 1: month = "February";
		break;
		case 2: month = "March";
		break;
		case 3: month = "April";
		break;
		case 4: month = "May";
		break;
		case 5: month = "June";
		break;
		case 6: month = "July";
		break;
		case 7: month = "August";
		break;
		case 8: month = "September";
		break;
		case 9: month = "October";
		break;
		case 10: month = "November";
		break;
		case 11: month = "December";
		break;
		default: month = "";
		break;
	}
	return month;
}
function get_current_month(){
	var date = new Date();
	date.setMonth(date.getMonth()+current_index);
	date.setDate(1);
	return date;
}

function get_year(){

	var date = new Date();
	date.setMonth(date.getMonth() + current_index);
	return date.getFullYear();
}

$(document).ready(function(){
	
	init();
	center_content();
	$('#back').click(previous);
	$('#forward').click(next);
	$('#today').click(init);
	$('.btn').mousedown(function(){
		event.preventDefault();
		$(this).addClass('clicked');
		if(this.id == 'back')
			$('#left').addClass('extended_line_div');
		else if(this.id == 'today')
			$('.line_div').addClass('extended_line_div');
		else if(this.id == 'forward')
			$('#right').addClass('extended_line_div');
	});
	$('.btn').mouseup(function(){
		event.preventDefault();
		$(this).removeClass('clicked');
		if(this.id == 'back')
			$('#left').removeClass('extended_line_div');
		else if(this.id == 'today')
			$('.line_div').removeClass('extended_line_div');
		else if(this.id == 'forward')
			$('#right').removeClass('extended_line_div');
	});
	$('.btn').mouseout(function(){
		$(this).mouseup();
	});

})
</script>
<div style="float:left;padding-left:40px;padding-top:10px">
	<a style="text-decoration: none;" href="<? echo $base_url?>/training/last">
		<img src="<?php echo $site_url?>/images/back2.png" alt="Back" height="45" width="45">
	</a>
</div>
<div id="main">
	<div id="head">
		<div id="month_label_container">
			<h1 id="month_label">August 2013</h1>
		</div>
		<!--<div id="test">
		</div>-->
		<div id="navigate_button_container">
			<div id="navigate_button">
				<div id="back" class="btn">
				</div>
				<div id="today" class="btn">
					<div class="line_div" id="left"></div>
					<span id="today_text">Today</span>
					<div class="line_div" id="right"></div>
				</div>
				<div id="forward" class="btn">
				</div>
			</div>
		</div>
	</div>
	<div id="body">
		<div id="calendar">
			
		</div>
	</div>
</div>