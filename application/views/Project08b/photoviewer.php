
<?php
	$url_array = array();
	
	foreach($photos as $photo)
		array_push($url_array, $photo['url']);
?>
<script>

var urls;
$(document).ready(function(){

	center_content();

	var username = "<?php echo $user['firstname'].' '.$user['lastname']; ?>";
	$('#logoff_label').text(username);
	var url_string = '<?php echo json_encode($url_array); ?>';
	var urls_length = 0;
	urls = "";
	if(url_string != "[]"){
		urls = eval(url_string);
	}

	init();
	// alert(urls[0]);
	if(urls.length != 0)
		var ip = new ImagePreloader(urls, onPreload);
	//init();
	
});
</script>
</head>

<body>
<div style="float:left;padding-left:40px;padding-top:10px">
	<a style="text-decoration: none;" href="<? echo $base_url?>/training/last">
		<img src="<?php echo $site_url?>/images/back2.png" alt="Back" height="45" width="45">
	</a>
</div>

<div id="main">
	<div id="upload">

		<?php 
			echo form_open('/training/logout');
			echo form_submit('logout', 'Log out', "id='sign_out' class='button'");
			echo form_close();
		?>
		<label for="sign_out" id="logoff_label"></label>
		<?php echo $error; ?>
		<?php echo form_open_multipart("upload/do_upload/$user[user_id]"); ?>
		<input type="file" name="userfile" size="20">
		<br><br>
		<input type="submit" value="upload">
		<?php echo form_close(); ?>
	</div>
	<div id="photos_bg">
		<div id="window">
			<div id="slider">
				<div class="panel" id="left">
					<div class="photo" id="top_left"></div>
					<div class="photo" id="top_right"></div>
					<div class="photo" id="bottom_left"></div>
					<div class="photo" id="bottom_right"></div>
				</div>
				<div class="panel" id="center">
					<div class="photo" id="top_left"></div>
					<div class="photo" id="top_right"></div>
					<div class="photo" id="bottom_left"></div>
					<div class="photo" id="bottom_right"></div>
				</div>
				<div class="panel" id="right">
					<div class="photo" id="top_left"></div>
					<div class="photo" id="top_right"></div>
					<div class="photo" id="bottom_left"></div>
					<div class="photo" id="bottom_right"></div>
				</div>
			</div>
			<div class="arrow" id="larrow"><img src="../../images/left_arrow.png" alt="left_arrow"></div>
			<div class="arrow" id="rarrow"><img src="../../images/right_arrow.png" alt="right_arrow"></div>
		</div>
	</div>
	
</div>
</body>
</html>