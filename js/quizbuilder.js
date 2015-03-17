function Header(target){
	var me = this;
	this.target= target;
	this.width = target.width();
	this.height = target.height();
	this.frame = $('<div id="head_frame"></div>');

	this.form = $('<form action="update_quiz.php" method="post"></form>');

	this.time_div = $('<div id="time"></div>');
	this.time_label = $('<label for="limit" id="limit_label">Time limit:</label>');
	this.time_limit = $('<input id="limit" type="text" name="timelimit">');

	this.quiz_div = $('<div id="quiz">Quiz #1</div>');

	this.question_div = $('<div id="question_div"></div>');
	this.question_label = $('<label for="question" id="question_label">Question:</label>');
	this.question_input = $('<textarea id="question" name="question" rows="10" cols="20"></textarea>');

	this.answer_div = $('<div id="answer_div"></div>');
	this.answer_label = $('<label for="answer" id="answer_label">Answer:</label>');
	this.answer_input = $('<textarea id="answer" name="answer" rows="10" cols="20"></textarea>');

	this.add_div = $('<div id="add_button"></div>');
	this.add_btn = $('<input type="submit" id="submit" value="Add question">');
	this.frame.append(
		this.form.append(
			this.time_div.append(
				this.time_label,
				this.time_limit
				),
			this.quiz_div,
			this.question_div.append(
				this.question_label,
				this.question_input
				),
			this.answer_div.append(
				this.answer_label,
				this.answer_input
				),
			this.add_div.append(
				this.add_btn
				)
			)
		);

	this.load = function(){
		this.frame.css({
			backgroundColor:'#197ABA',
			width:this.width+'px',
			height:this.height+'px'
		});
		this.time_div.css({
			float:'right',
			marginRight:'5px',
			marginTop:'5px'
		});
		this.question_div.css({
			display:'inline-block',
			paddingLeft:'5px',
			paddingRight:'5px'
		});
		this.answer_div.css({
			display:'inline-block',
			paddingLeft:'10px',
			paddingRight:'10px'
		});
		this.add_div.css({
			display:'inline-block',
			paddingRight:'5px'
		});

		this.target.append(this.frame);
	}
	this.load();
}

Header.width = function(newWidth){
	this.width = newWidth;
	this.load();
	return this.width;
}
Header.width = function(){
	return this.width;
}
Header.height = function(newHeight){
	this.height = newHeight;
	this.load();
	return this.height;
}
Header.height = function(){
	return this.height;
}
