<html>
<head>
<style>

#block {
	background-color:#99FF99;
	width:700px;
	height:134px;
	padding-top:14px;
}
.bottom {
	position:relative;
}
#one {
	background-color:#FFFFDB;
	float:right;
	margin-right:100px;
}
#two {
	background-color:#FFFFDB;
	float:left;
	margin-left:100px;
}
#three {
	background-color:#99CCFF;
	display:inline-block;
	margin-left:100px;
}
#four {
	background-color:#99CCFF;
	display:inline-block;
	margin-left:100px;
}
#five {
	background-color:#99CCFF;
	position:absolute;
	left:100px;
	//top:14px;
}
#six {
	background-color:#99CCFF;
	position:absolute;
	right:100px;
	//top:14px;
}
div.small {
	width:200px;
	height:120px;
	border:1px;
	border-style:solid;
	border-color:#800000;
	//margin-top:14px;
	//margin-bottom:auto;
}


</style>
</head>
<body>
float: left; float: right;
<div id="block">
<div id="one" class="small">div 1
</div>
<div id="two" class="small">div 2
</div>
</div>
<br>
<br>

display: inline-block;
<div id="block">
<div id="three" class="small">div 3
</div>
<div id="four" class="small">div 4
</div>
</div>
<br>
<br>

Using Absolute Positioning
<div id="block" class="bottom">
<div id="five" class="small">div 5
</div>
<div id="six" class="small">div 6
</div>
</div>




</body>
<html>