<html>
<head>
	<?php
$con=mysqli_connect('localhost','root','root');
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Create database
$sql="CREATE DATABASE tictactoe";
if (mysqli_query($con,$sql))
  {
  echo "Database my_db created successfully";
  }
else
  {
  echo "Error creating database: " . mysqli_error($con);
  }
?>
<?php
$con=mysqli_connect('localhost','root','root','tictactoe');
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Create table
$sql="CREATE TABLE Board(Left CHAR(1),Center CHAR(1),Right CHAR(1))";

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "Table board created successfully";
  }
else
  {
  echo "Error creating table: " . mysqli_error($con);
  }
?>
<style>
#main{
	width:800px;
	height:500px;
}
#board{
	background-color: black;
	float:left;
	width:500px;
	height:500px;
}
#holder{
	float:left;
	background-color: blue;
	width:200px;
	height:500px;
}
.cell{
	float:left;
	background-color: white;
	width:150px;
	height:150px;
}
#left, #center{
	margin-right:25px;
}
.middle, .bottom{
	margin-top:25px; 
}
.subHolder{
	float:left;
	width:100px;
	height:500px;
}
.marker{
	font-size:120px;
	font-family: arial;
	font-weight: bold;
	line-height: 80%;
	float:left;
	width:100px;
	height:100px;
}
</style>
<script>
	var marker;
	var activePlayer;
	var markerList = new Array(9);
	var markersPlaced = 0;

	function newGame(){
		marker = null;
		activePlayer = null;
		markerList = new Array(9);
		markersPlaced = 0;
		for (var i = 9; i >= 0; i--) {

			var tempMarker = document.getElementsByClassName('marker')[i];
			tempMarker.removeAttribute('style');
			document.getElementById(tempMarker.id+'Holder').appendChild(tempMarker);
		}
	}
	function selectMarker(ev) {
		marker = ev.target;
		if(activePlayer == null)
			activePlayer = marker.id;
		if(marker.id == activePlayer){
			document.addEventListener('mousemove',dragMarker);
			document.addEventListener('mouseup',placeMarker);
			document.getElementById('main').appendChild(marker);
			marker.style.position = "absolute";
			marker.style.left = ev.x-50+'px';
			marker.style.top = ev.y-50+'px';
		}else{
			alert('Hey! It\'s '+activePlayer.toUpperCase()+'\'s turn!');
		}
		
	}
	function dragMarker(ev){
		marker.style.left = ev.x-50+'px';
		marker.style.top = ev.y-50+'px';
	}
	function placeMarker(ev){
		document.removeEventListener('mousemove',dragMarker);
		document.removeEventListener('mouseup',placeMarker);
		marker.removeAttribute('style');
		var toCell = getCellBelow(ev.x,ev.y);
		if(toCell != null && toCell.children.length == 0){
			addMarkerToCell(toCell);
		}else{
			var label = '';
			//marker.removeAttribute('style');
			if(marker.id == 'x' || marker.id == 'o')
				label = 'Holder';
			var holder = document.getElementById(marker.id+label);
			if(holder != null)
				holder.appendChild(marker);
		}
	}
	function addMarkerToCell(cell){
		marker.style.width = cell.offsetWidth+'px';
		marker.style.height = cell.offsetHeight+'px';

		//marker.style.position = 'static';
		//marker.style.float = 'left';
		marker.style.fontSize = '200px';
		cell.appendChild(marker);
		activePlayer = marker.id=='x'?'o':'x';
		markersPlaced++;
		addToArray(cell);
		if(gameOver())
			newGame();
	}
	function addToArray(cell){
		var index = Number(cell.getAttribute('name'));
		cell.name = index;
		markerList[index] = marker.id;
	}
	function gameOver(){
		if(markersPlaced >= 5){
			var winner = null;
			//check for win
			if(markerList[0] == markerList[1] && markerList[1] == markerList[2] && markerList[2] != undefined 
			|| markerList[0] == markerList[3] && markerList[3] == markerList[6] && markerList[6] != undefined
			|| markerList[0] == markerList[4] && markerList[4] == markerList[8] && markerList[8] != undefined
			|| markerList[1] == markerList[4] && markerList[4] == markerList[7] && markerList[7] != undefined
			|| markerList[2] == markerList[4] && markerList[4] == markerList[6] && markerList[6] != undefined
			|| markerList[2] == markerList[5] && markerList[5] == markerList[8] && markerList[8] != undefined
			|| markerList[3] == markerList[4] && markerList[4] == markerList[5] && markerList[5] != undefined
			|| markerList[6] == markerList[7] && markerList[7] == markerList[8] && markerList[8] != undefined)
				winner = marker.innerText;
			//different method fo checking for win
			/*switch(cell.name){
				case 0: if(markerList[1] == marker.id && markerList[2] == marker.id 
						|| markerList[3] == marker.id && markerList[6] == marker.id
						|| markerList[4] == marker.id && markerList[8] == marker.id)
							winner = marker.innerText;

				break;
				case 1: if(markerList[0] == marker.id && markerList[2] == marker.id 
						|| markerList[4] == marker.id && markerList[7] == marker.id)
							winner = marker.innerText;
				break;
				case 2: if(markerList[0] == marker.id && markerList[1] == marker.id 
						|| markerList[4] == marker.id && markerList[6] == marker.id
						|| markerList[5] == marker.id && markerList[8] == marker.id)
							winner = marker.innerText;
				break;
				case 3: if(markerList[0] == marker.id && markerList[6] == marker.id 
						|| markerList[4] == marker.id && markerList[5] == marker.id)
							winner = marker.innerText;
				break;
				case 4: if(markerList[0] == marker.id && markerList[8] == marker.id 
						|| markerList[1] == marker.id && markerList[7] == marker.id
						|| markerList[2] == marker.id && markerList[6] == marker.id
						|| markerList[3] == marker.id && markerList[5] == marker.id)
							winner = marker.innerText;
				break;
				case 5: if(markerList[2] == marker.id && markerList[8] == marker.id 
						|| markerList[3] == marker.id && markerList[4] == marker.id)
							winner = marker.innerText;
				break;
				case 6: if(markerList[0] == marker.id && markerList[3] == marker.id 
						|| markerList[2] == marker.id && markerList[4] == marker.id
						|| markerList[7] == marker.id && markerList[8] == marker.id)
							winner = marker.innerText;
				break;
				case 7: if(markerList[1] == marker.id && markerList[4] == marker.id 
						|| markerList[6] == marker.id && markerList[8] == marker.id)
							winner = marker.innerText;
				break;
				case 8: if(markerList[0] == marker.id && markerList[4] == marker.id 
						|| markerList[2] == marker.id && markerList[5] == marker.id
						|| markerList[6] == marker.id && markerList[7] == marker.id)
							winner = marker.innerText;
				break;
				default: winner = null;
				break;
			}*/
			if(winner != null){
				alert(winner+' Wins!');
				return true;
			}else if(markersPlaced == 9){
				alert('Its a draw!');
				return true;
			}else
				return false;
			
		}

	}
	function getCellBelow(x,y){
		
		var yPos = 8<y&&y<158 ? "top" : 183<y&&y<325 ? "middle" : 358<y&&y<508 ? "bottom" : null;
		var xPos = 8<x&&x<158 ? 0 : 183<x&&x<325 ? 1 : 358<x&&x<508 ? 2 : null;
		if(yPos != null && xPos != null)
			return document.getElementsByClassName(yPos)[xPos];
		else return null;
	}
</script>
</head>

<body>
	<div id="main">
		<div id="board">
			<div class="cell top" id="left" name="0"></div>
			<div class="cell top" id="center" name="1"></div>
			<div class="cell top" id="right" name="2"></div>
			<div class="cell middle" id="left" name="3"></div>
			<div class="cell middle" id="center" name="4"></div>
			<div class="cell middle" id="right" name="5"></div>
			<div class="cell bottom" id="left" name="6"></div>
			<div class="cell bottom" id="center" name="7"></div>
			<div class="cell bottom" id="right" name="8"></div>
		</div>
		<div id="holder" onmousedown="selectMarker(event)">
			<div class="subHolder" id="xHolder">
				<div class="marker" id="x">X</div>
				<div class="marker" id="x">X</div>
				<div class="marker" id="x">X</div>
				<div class="marker" id="x">X</div>
				<div class="marker" id="x">X</div>
			</div>
			<div class="subHolder" id="oHolder">			
				<div class="marker" id="o">O</div>
				<div class="marker" id="o">O</div>
				<div class="marker" id="o">O</div>
				<div class="marker" id="o">O</div>
				<div class="marker" id="o">O</div>
			</div>
		</div>
	</div>
</body>
</html>