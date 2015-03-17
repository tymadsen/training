<!DOCTYPE html>
<html>
<head>
	<title>Training</title>
	<script src="<?php echo $site_url; ?>/js/jquery.min.js"></script>
	<script src="<?php echo $site_url; ?>/js/jquery.jgrowl.min.js"></script>
	<link rel='stylesheet' type='text/css' href='<?php echo $site_url; ?>/css/jquery.jgrowl.min.css'>
	<?php 
		// echo $site_url;
		if(isset($js))
			foreach($js as $script)
				echo "<script src='$site_url/js/$script.js'></script>\n\t";
		if(isset($css))
			foreach($css as $ss)
				echo "<link rel='stylesheet' type='text/css' href='$site_url/css/$ss.css'>\n\t";
	?>
	<!-- <script src="<?php echo $site_url; ?>/js/bootstrap.min.js"></script> -->
	<!-- <link rel='stylesheet' type='text/css' href='<?php echo $site_url; ?>/css/bootstrap.min.css'> -->
</head>
<body>
	<div id="header" style="height:1px;">
		<!-- <h1>This is my header!</h1> -->
		<div id="home" style="float:right;padding-right:40px;padding-top:10px">
			<a href="<?php echo $base_url; ?>">
				<img src="<?php echo $site_url; ?>/images/home.png" alt="home" height="50" width="50">
			</a>
		</div>
	</div>

