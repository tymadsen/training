


document.addEventListener('mousemove',drawCoords);
function drawCoords(){
	
	var x = event.x;
	var y = event.y;
	var coords = document.getElementById('coords');
	coords.innerHTML = "("+x+","+y+")";
	coords.style.position = "absolute";
	coords.style.left = x+"px";
	coords.style.top = y+"px";
	coords.style.zIndex = 400;
}