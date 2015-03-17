<link rel="stylesheet" type="text/css" href="<?php echo $site_url; ?>/css/money.css">
<script>
	var selected;
	var isSelected = false;
	var solution;
	var bankCount;

	function newProblem(){
		bankCount = 0;
		//clear grid
		var grid = document.getElementById('grid');
		for(var i = 0;i<grid.children.length;i++){
			while(grid.children[i].children.length>0){
				grid.children[i].removeChild(grid.children[i].lastElementChild);
			}
		}
		//create new problem
		var randomMax = Math.floor((Math.random()*10)+1);
		solution = Math.floor((Math.random()*500*randomMax)+1);
		var amt = new Number(solution/100).toPrecision(solution.toString().length);
		document.getElementById('problem').innerHTML=('$'+amt);
	}
	function checkAnswer(){
		var bankAmtFormat = solution.toString().length;
		var message = 'You have $'+(bankCount/100).toPrecision(bankCount.toString().length)+' in your bank.\n';
		if(bankCount == solution){
			alert(message+'Nailed it!');
			newProblem();
		}else
			alert(message+'Sorry, that is incorrect.\nYou need $'+solution/100+'.\n Keep trying!');
	}
	function selectMoney(ev){
		isSelected = true;
		selected = ev.target.parentNode.cloneNode(true);
		selected.style.float = "left";
		selected.style.marginTop = "0px";
		document.addEventListener('mousemove',moveMoney);
		document.addEventListener('mouseup',dropMoney);
		document.getElementById('main').appendChild(selected);
		selected.style.position = "absolute";
		selected.style.left = ev.clientX-25+'px';
		selected.style.top = ev.clientY-25+'px';
	}
	function moveMoney(ev){
		if(isSelected){
			//selected.style.position = "absolute";
			selected.style.left = ev.clientX-25+'px';
			selected.style.top = ev.clientY-25+'px';
		}
	}
	function dropMoney(ev){
		isSelected = false;
		selected.style.position="static";
		document.removeEventListener('mousemove',moveMoney);
		document.removeEventListener('mouseup',dropMoney);
		var box = document.getElementById(selected.id+'Box');
		if(isOverElement(ev.clientX,ev.clientY,document.getElementById('grid')) 
			&& box != null 
			&& box.children.length<9) {
			box.appendChild(selected);
			bankCount += valueof(selected);
		}else{
			document.getElementById('main').removeChild(document.getElementById('main').lastChild);
		}
		selected.onmousedown = null;
		selected.addEventListener('click',removeMoney);
		selected = null;
	}
	function removeMoney(){
		bankCount -= valueof(this);
		this.removeEventListener('click',removeMoney);
		this.parentNode.removeChild(this);
	}
	function valueof(element){
		var type = element.id;
		var value = 0;
		switch(type){
			case 'penny': value = 1;
			break;
			case 'nickel': value = 5;
			break;
			case 'dime': value = 10; 
			break;
			case 'quarter': value = 25;
			break;
			case 'fifty': value = 50;
			break;
			case 'dollar': value = 100;
			break;
			case 'fiveDollar': value = 500;
			break;
			default: value = 0;
			break;
		}
		return value;

	}
	function isOverElement(x,y,element){
		if(x>getOffsetLeft(element) 
			&& y>getOffsetTop(element) 
			&& x<(getOffsetLeft(element)+element.offsetWidth) 
			&& y<(getOffsetTop(element)+element.offsetHeight))
			return true;
		else
			return false;
	}
	function getOffsetLeft(currentNode){
		var offsetLeft = 0;
		while(currentNode.id != "main"){
			if(currentNode.offsetLeft != undefined){
				offsetLeft += currentNode.offsetLeft;
			}
			currentNode = currentNode.parentNode;
		}
		return offsetLeft;
	}
	function getOffsetTop(currentNode){
		var offsetTop = 0;
		while(currentNode.id != "main"){
			if(currentNode.offsetTop != undefined){
				offsetTop += currentNode.offsetTop;
			}
			currentNode = currentNode.parentNode;
		}
		return offsetTop;
	}

	$(function(){newProblem()});
</script>

<p id="coords"></p>
<div id="main">
	<div id="problem"></div>
	<div class="display" id="grid">
		
		<div id="pennyBox" class="bank" style="width:156px;height:153px;float:left;"></div>
		<div id="nickelBox" class="bank" style="width:160px;height:155px;float:left"></div>
		<div id="dimeBox" class="bank" style="width:160px;height:155px;float:left;"></div>
		<div id="quarterBox" class="bank" style="width:160px;height:155px;float:left;"></div>
		<div id="fiftyBox" class="bank" style="width:160px;height:155px;float:left;"></div>
		<div id="dollarBox" class="bank" style="width:350px;height:155px;float:left;"></div>
		<div id="fiveDollarBox" class="bank" style="width:350px;height:155px;float:left;"></div>
		
	</div>
	<div class="money">
		<div id="penny" class="coin" onmousedown="selectMoney(event)">
			<img src="<?php echo $site_url; ?>/images/penny.png" alt="Penny" width="50px" height="50px" draggable="false"></img>
		</div>
		
		<div id="nickel" class="coin" onmousedown="selectMoney(event)">
			<img src="<?php echo $site_url; ?>/images/nickel_front.png" alt="Nickel" width="50px" height="50px" draggable="false"></img>
		</div>
		
		<div id="dime" class="coin" onmousedown="selectMoney(event)">
			<img src="<?php echo $site_url; ?>/images/dime_front.png" alt="Dime" width="50px" height="50px" draggable="false"></img>
		</div>
		
		<div id="quarter" class="coin" onmousedown="selectMoney(event)">
			<img src="<?php echo $site_url; ?>/images/quarter_front.png" alt="Quarter" width="50px" height="50px" draggable="false"></img>
		</div>
		
		<div id="fifty" class="coin" onmousedown="selectMoney(event)">
			<img src="<?php echo $site_url; ?>/images/half_front.png" alt="Half Dollar" width="50px" height="50px" draggable="false"></img>
		</div>
		
		<div id="dollar" class="bill" onmousedown="selectMoney(event)">
			<img src="<?php echo $site_url; ?>/images/dollar.jpg" alt="Dollar" width="115px" height="50px" draggable="false"></img>
		</div>
		
		<div id="fiveDollar" class="bill" onmousedown="selectMoney(event)">
			<img src="<?php echo $site_url; ?>/images/fivedollarbill.jpg" alt="Five Dollars" width="115px" height="50px" draggable="false"></img>
		</div>
		
		<button id="button" name="check" onclick="checkAnswer()">Check</button>
	</div>
	
</div>