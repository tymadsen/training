<style type="text/css">
	.jGrowl .error {
				background-color: 		#FF0000;
				color: 					white;
			}
	.jGrowl .success {
				background-color: 		#00FF00;
				color: 					white;
			}
	.jGrowl .message {
				background-color: 		#0000FF;
				color: 					white;
			}
</style>
<script>
	<?php 
		if(isset($message))
			echo $message;
	?>
</script>
	<div id="message"></div>
	<div id="footer">
		
	</div>
</body>
</html>
