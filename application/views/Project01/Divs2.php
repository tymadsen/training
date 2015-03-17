<html>
<head>
<style>

.table {
	background-color:#99FF99;
	width:700px;
	height:150px;
}
#top {
	//float:left;
}
#middle {
	//display:inline-block;
}
#bottom {
	position:absolute;
}
.table div{
	background-color:#FFFFDC;
	border:1px solid black;
	width:120px;
	height:20px;
}
#top div{
	float:left;
}
#middle div{
	display:inline-block;
}
#bottom div{
	position:absolute;
}

#top div.column1 {
	margin-left:50px;
}
#top div.column2, #top div.column3, #top div.column4, #top div.column5 {
	margin-left:-1px;
}
#top div#row2,#top div#row3,#top div#row4,#top div#row5{
	margin-top:-1px;
}

#middle div.column1 {
	margin-left:50px;
}
#middle div.column2, #middle div.column3, #middle div.column4, #middle div.column5{
	margin-left:-5px;
}
#middle div#row2,#middle div#row3,#middle div#row4,#middle div#row5{
	margin-top:-1px;
}

#bottom div.column1 {
	left:50px;
}
#bottom div.column2 {
	left:170px;
}
#bottom div.column3 {
	left:290px;
}
#bottom div.column4 {
	left:410px;
}
#bottom div.column5 {
	left:530px;
}

#row1 {
	top:0px;
}
#row2 {
	top:20px;
}
#row3 {
	top:40px;
}
#row4 {
	top:60px;
}
#row5 {
	top:80px;
}

</style>
</head>

<body>
Table 1: Using float
<div id="top" class="table">
	<div class="column1" id="row1">cell 1</div>
	<div class="column2" id="row1">cell 2</div>
	<div class="column3" id="row1">cell 3</div>
	<div class="column4" id="row1">cell 4</div>
	<div class="column5" id="row1">cell 5</div>
	<div class="column1" id="row2">cell 1</div>
	<div class="column2" id="row2">cell 2</div>
	<div class="column3" id="row2">cell 3</div>
	<div class="column4" id="row2">cell 4</div>
	<div class="column5" id="row2">cell 5</div>
	<div class="column1" id="row3">cell 1</div>
	<div class="column2" id="row3">cell 2</div>
	<div class="column3" id="row3">cell 3</div>
	<div class="column4" id="row3">cell 4</div>
	<div class="column5" id="row3">cell 5</div>
	<div class="column1" id="row4">cell 1</div>
	<div class="column2" id="row4">cell 2</div>
	<div class="column3" id="row4">cell 3</div>
	<div class="column4" id="row4">cell 4</div>
	<div class="column5" id="row4">cell 5</div>
	<div class="column1" id="row5">cell 1</div>
	<div class="column2" id="row5">cell 2</div>
	<div class="column3" id="row5">cell 3</div>
	<div class="column4" id="row5">cell 4</div>
	<div class="column5" id="row5">cell 5</div>
</div>

<br>
<br>

Table 2: Using inline-block
<div id="middle" class="table">
	<div class="column1" id="row1">cell 1</div>
	<div class="column2" id="row1">cell 2</div>
	<div class="column3" id="row1">cell 3</div>
	<div class="column4" id="row1">cell 4</div>
	<div class="column5" id="row1">cell 5</div>
	<div class="column1" id="row2">cell 1</div>
	<div class="column2" id="row2">cell 2</div>
	<div class="column3" id="row2">cell 3</div>
	<div class="column4" id="row2">cell 4</div>
	<div class="column5" id="row2">cell 5</div>
	<div class="column1" id="row3">cell 1</div>
	<div class="column2" id="row3">cell 2</div>
	<div class="column3" id="row3">cell 3</div>
	<div class="column4" id="row3">cell 4</div>
	<div class="column5" id="row3">cell 5</div>
	<div class="column1" id="row4">cell 1</div>
	<div class="column2" id="row4">cell 2</div>
	<div class="column3" id="row4">cell 3</div>
	<div class="column4" id="row4">cell 4</div>
	<div class="column5" id="row4">cell 5</div>
	<div class="column1" id="row5">cell 1</div>
	<div class="column2" id="row5">cell 2</div>
	<div class="column3" id="row5">cell 3</div>
	<div class="column4" id="row5">cell 4</div>
	<div class="column5" id="row5">cell 5</div>
</div>
<br>
<br>

Table 3: Using absolute positioning

<div id="bottom" class="table">
	<div class="column1" id="row1">cell 1</div>
	<div class="column2" id="row1">cell 2</div>
	<div class="column3" id="row1">cell 3</div>
	<div class="column4" id="row1">cell 4</div>
	<div class="column5" id="row1">cell 5</div>
	<div class="column1" id="row2">cell 1</div>
	<div class="column2" id="row2">cell 2</div>
	<div class="column3" id="row2">cell 3</div>
	<div class="column4" id="row2">cell 4</div>
	<div class="column5" id="row2">cell 5</div>
	<div class="column1" id="row3">cell 1</div>
	<div class="column2" id="row3">cell 2</div>
	<div class="column3" id="row3">cell 3</div>
	<div class="column4" id="row3">cell 4</div>
	<div class="column5" id="row3">cell 5</div>
	<div class="column1" id="row4">cell 1</div>
	<div class="column2" id="row4">cell 2</div>
	<div class="column3" id="row4">cell 3</div>
	<div class="column4" id="row4">cell 4</div>
	<div class="column5" id="row4">cell 5</div>
	<div class="column1" id="row5">cell 1</div>
	<div class="column2" id="row5">cell 2</div>
	<div class="column3" id="row5">cell 3</div>
	<div class="column4" id="row5">cell 4</div>
	<div class="column5" id="row5">cell 5</div>
</div>

</body>
<html>