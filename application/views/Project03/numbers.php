<style type="text/css">
td{
	border:1px solid black;
}
table{
	border:1px solid black;
	height:130px;
	width:220px;
}
#board{
	background-color:blue;
	position:relative;
	height:500px;
	width:700px;
}
#sequence{
	position:relative;
	font:italic bold 64px Times, serif;
	color: white;
	width:600px;
	height:80px;
	top:100px;
	left:50px;
}
</style>
<script>


	var answer = 0;
	var qNumberCount = 0;
	var rightCount = 0;
	var wrongCount = 0;
	var percentRightCount = 100;
	var answered = false;

	function init(){
		answered = false;
		document.getElementById('qNumber').innerHTML = 1;
		document.getElementById('right').innerHTML = 0;
		document.getElementById('wrong').innerHTML = 0;
		document.getElementById('percentRight').innerHTML = 100+"%";
		newProblem();

	}

	function checkAnswer(){
		//alert(answered);
		var userAnswer = document.getElementById('input').value;
		if(userAnswer == answer){
			alert('Nailed it!');
			if(!answered)
				rightCount++;
			document.getElementById('right').innerHTML = rightCount;
			newProblem();
		}
		else{
			alert('Sorry, that is incorrect. Try again!');
			if(!answered)
				wrongCount++;
			document.getElementById('wrong').innerHTML = wrongCount;
			answered = true;
		}
		if(rightCount+wrongCount != 0)
			document.getElementById('percentRight').innerHTML = Math.round(rightCount/(rightCount+wrongCount)*100)+"%";
		else
			document.getElementById('percentRight').innerHTML = Math.round(rightCount/qNumberCount*100)+"%";
		document.getElementById('input').value = "";
	}
	function newProblem(){
		answered = false;
		//alert('new problem clicked');
		qNumberCount++;
		document.getElementById('qNumber').innerHTML = qNumberCount;
		var seqStart = Math.floor((Math.random()*50)+1);
		var seqStep = Math.floor((Math.random()*10)+1);
		var seqSize = Math.floor((Math.random()*5)+3);
		var leftOut = Math.floor(Math.random()*seqSize);
		var seqOperationSelector = Math.floor(Math.random()*2);//add or subtract 0=add, 1=subtract
		if(seqOperationSelector == 1)
			seqStep = 0-seqStep;
		//alert(leftOut);
		answer = seqStart+(leftOut*seqStep);
		var problem = "";
		for(var i = 0;i<seqSize;i++){
			var num = seqStart+(i*seqStep);
			if(i!=leftOut){
				problem += num + " ";
			}else{
				problem += "_ "
			}
		}
		document.getElementById('sequence').innerHTML = problem;
	}

	$(function(){init();});

</script>

<div id="board">
	<p id="sequence"></p>
</div>
<div style="position:absolute;" onload="init">
	<div>
		<div>
			<p style="font-size:36px">Fill in the missing number</p>
		</div>
		<div style="position:absolute;">
			<div style="position:absolute;left:50px;">
				<input id="input" type="text"></input>
			</div>
			<div style="position:absolute;left:275px;">
				<button name="CheckAnswer" style="width:120px;" onclick="checkAnswer()">Check Answer</button>
				<button name="NewProblem" style="width:120px;" onclick="newProblem()">New Problem</button>
			</div>
		</div>
	</div>
	<div style="position:absolute;left:450px;top:30px;">
		<table>
			<tr>
				<td>Question Number</td>
				<td id="qNumber"></td>
			</tr>
			<tr>
				<td>Right</td>
				<td id="right"></td>
			</tr>
			<tr>
				<td>Wrong</td>
				<td id="wrong"></td>
			</tr>
			<tr>
				<td>Percent Right</td>
				<td id="percentRight"></td>
			</tr>
		</table>
	</div>
</div>