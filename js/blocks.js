
var currentBlock;
var protoType;
var dragging = false;
var xOffset = 0;
var yOffset = 0;
var divs = document.getElementsByTagName('DIV');
var blockCount = 0;
var solution;
var overGrid;
function selectBlock(event){
	dragging = true;
	overGrid = false;
	protoType = event.target.parentNode;
	currentBlock = protoType.cloneNode(true);
	currentBlock.style.cursor = "move";
	document.getElementById('main').appendChild(currentBlock);
	currentBlock.style.position = 'absolute';
	document.addEventListener('mousemove',dragBlock);
	document.addEventListener('mouseup',releaseBlock);
	var x = getOffsetLeft(protoType);
	var y = getOffsetTop(protoType);
	xOffset = event.clientX-x;
	yOffset = event.clientY-y;
	currentBlock.style.left = x+'px';
	currentBlock.style.top = y+'px';	
	
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
function isOverElement(x,y,element){
	if(x>getOffsetLeft(element) 
		&& y>getOffsetTop(element) 
		&& x<(getOffsetLeft(element)+element.offsetWidth) 
		&& y<(getOffsetTop(element)+element.offsetHeight))
		return true;
	else
		return false;
}
function dragBlock(event){
	if(dragging){
		overGrid = isOverElement(event.clientX,event.clientY,document.getElementById('grid'));
		var xPos = event.clientX-xOffset;
		var yPos = event.clientY-yOffset;
		currentBlock.style.left=xPos+'px';
		currentBlock.style.top=yPos+'px';	
	}
}
function releaseBlock(){
	dragging = false;
	if(overGrid)
		dropBlock();
	else
		document.getElementById('main').removeChild(document.getElementById('main').lastChild);	
	document.removeEventListener('mousemove',dragBlock);
	document.removeEventListener('mouseup',releaseBlock);
}
function dropBlock(){
	currentBlock.style.cursor = "default";
	currentBlock.style.float = "left";
	currentBlock.style.position = 'static';
	blockCount += currentBlock.childElementCount;
	document.getElementById(currentBlock.className).appendChild(currentBlock);
	currentBlock.onmousedown = null;
	currentBlock.addEventListener('click',removeBlock);
}
function removeBlock(){
	this.removeEventListener('click',removeBlock);
	this.parentNode.removeChild(this);
	blockCount -= this.childElementCount;
}
function getCoords(ev){
	var x = ev.clientX;
	var y = ev.clientY;
	var coords = document.getElementById('coords');
	coords.innerHTML = "("+x+","+y+")";
	coords.style.position = 'relative';
	coords.style.left = x+'px';
	coords.style.top = y+'px';
	coords.style.zIndex = 200;
}
function checkAnswer(){
	if(blockCount == solution){
		alert('Nailed it!\n'+blockCount+' blocks is right!');
		newProblem();
	}
	else{
		alert('You have '+blockCount+' blocks. Sorry, that is incorrect. Keep Working on it!');
	}
}
function newProblem(){
	var operator = '+';
	var firstNum = Math.floor((Math.random()*500)+1);
	var secondNum = Math.floor((Math.random()*500)+1);
	var seqOperationSelector = Math.floor(Math.random()*2);//add or subtract 0=add, 1=subtract
	if(seqOperationSelector == 1){
		if(firstNum<secondNum){
			var tempNum = firstNum;
			firstNum = secondNum;
			secondNum = tempNum;
		}
		solution = firstNum-secondNum;
		operator = '-';
	}
	else
		solution = firstNum+secondNum;
	var problem = firstNum+" "+operator+" "+secondNum;
	document.getElementById('problem').innerHTML = problem;
	var grid = document.getElementById('grid');
	for(var i = 0;i<grid.children.length;i++){
		while(grid.children[i].children.length>0){
			grid.children[i].removeChild(grid.children[i].lastChild);
		}	
	}
	blockCount = 0;

}