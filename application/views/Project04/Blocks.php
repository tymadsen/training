<link rel="stylesheet" type="text/css" href="<?php echo $site_url; ?>/css/blocks.css">
<script src="<?php echo $site_url; ?>/js/blocks.js"></script>
<script>
	$(function(){newProblem()});
</script>
<p id="coords"></p>
<div id="main">
	<div id="problem"></div>
	<div class="display" id="grid">
		
		<div id="tenBox" style="height:120px;width:240px;float:left;margin-left:10px;margin-top:10px;"></div>
		<div id="fiveBox" style="height:120px;width:120px;float:left;margin-left:10px;margin-top:10px;"></div>
		<div id="twoBox" style="height:120px;width:120px;float:left;margin-left:10px;margin-top:10px;"></div>
		<div id="oneBox" style="height:120px;width:120px;float:left;margin-left:10px;margin-top:10px;"></div>
		<div id="hundredBox" style="height:240px;width:720px;float:left;margin-left:10px;margin-top:10px;"></div>
		
	</div>
	<div class="blocks">
		<div id="one">
			<small>1</small>
			<div id="singleBlock" class="oneBox" onmousedown="selectBlock(event)">
				<div class="one"></div>
			</div>
		</div>
		<br>
		<br>
		<div id="two">
			2
			<div id="doubleBlock" class="twoBox" onmousedown="selectBlock(event)">
				<div class="one"></div>
				<div class="one"></div>
			</div>
		</div>
		<br>
		<br>
		<div id="five">
			5
			<div id="fiveBlock" class="fiveBox" onmousedown="selectBlock(event)">
				<div class="one"></div>
				<div class="one"></div>
				<div class="one"></div>
				<div class="one"></div>
				<div class="one"></div>
			</div>
		</div>
		<br>
		<br>
		<div id="ten">
			10
			<div id="tenBlock" class="tenBox" onmousedown="selectBlock(event)">
				<div class="one"></div>
				<div class="one"></div>
				<div class="one"></div>
				<div class="one"></div>
				<div class="one"></div>
				<div class="one"></div>
				<div class="one"></div>
				<div class="one"></div>
				<div class="one"></div>
				<div class="one"></div>
			</div>
		</div>
		<br>
		<br>
		<div id="hundred">
			100
			<div id="hundredBlock" class="hundredBox" onmousedown="selectBlock(event)">
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
				<div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div><div class="one"></div>
			</div>
		</div>
		<br>
		<br>
		<button id="button" name="check" onclick="checkAnswer()">Check</button>
	</div>
	
</div>
