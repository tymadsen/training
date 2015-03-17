<html>
<head>
<title><?php echo $title != null ? $title : "Default Title"; ?></title>
<style>
body{
	background: -webkit-linear-gradient(top, rgba(30,87,153,1) 0%, rgba(41,137,216,1) 50%, rgba(125,185,232,1) 100%);
}
#head{
	height:100px;
}
.button{
	border-radius: 10px;
	background-color: transparent;
}
#main{
	background-color:  white;
	position: relative;
	width:430px;
	height:130px;
}
#logout{
	position: absolute;
	right: 20px;
	top: 5px;
}
#heading{
	text-align: center;
	color: aliceblue;
}
#todos{
	position: absolute;
	right: 100px;
	border: 9px ridge blue;
	width: 20%;
	height: inherit;
}
#add_entry{
	position: absolute;
	border: 5px ridge blue;
	width: 40%;
	height: inherit;
}
label{
	position: relative;
	left: 20px;
	top: 5px;
	display: block;
}
.input{
	position:relative;
	left:25px;
	top:5px;
}
.submit{
	position:absolute;
	right:5px;
	bottom:5px;
}
#sign_up{
	float:right;
	position: relative;
	width: 110px;
}

</style>
<script>
</script>
</head>
<body>
	<div id="header">
		<h2> Welcome <?php echo $firstname . " " . $lastname; ?>!</h2>
		<div id="logout">
			
			<?php 
				echo form_open('blog/logout');
				echo form_submit(array(	'class'	=> 'button submit',
										'id' 	=> 'logout',
										'value' => 'Log out'
										)) . "<br>";
				echo form_close('');
			?>
		</div>
	</div>
	<h1 id="heading"><?php echo $heading != null ? $heading : "Default Heading"; ?></h1>
	<div id="todos">
		<h3 id="todo_label"><?php echo $firstname; ?>'s Todo List:</h3>
		<ol>
			<?php foreach($todo_list as $todo) : ?>
			<li><?= $todo->item; ?></li>
			<?php endforeach; ?>
		</ol>
		<div id="add_todo">
			<?php 
				echo form_open('blog/add_task');
				echo form_label('Item:', 'item');
				echo form_input(array(	'name'	=>	'item',
										'class'	=>	'input',
										'id'	=>	'item'
										)) . "<br>";
				echo form_submit(array(	'class'	=>	'button submit',
										'value'	=>	'Add todo'
										)) . "<br>";
				echo form_close('');
			?>
		</div>
		
	</div>
	<div id="blog_content">
		<div id="blog_entries"> 
			<table border="1px solid">
				<tr>
					<th>Title</th>
					<th>Content</th>
					<th style="width:80px">Date</th>
				</tr>
				<?php foreach($entries as $entry) : ?>
				<tr>
					<td><?php echo $entry->title; ?></td>
					<td><?php echo $entry->content; ?></td>
					<td><?php echo $entry->date; ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<div id="add_entry">
			<?php 
				echo form_open('blog/update');
				echo form_label('Title:', 'title');
				echo form_input(array(	'name'	=>	'title',
										'class'	=>	'input'
										)) . "<br>";
				echo form_label('Content:', 'content');
				echo form_textarea(array(	'name'	=>	'content',
											'class'	=>	'input',
											'cols'	=>	'45',
											'rows'	=>	'6'
										)) . "<br>";
				echo form_submit(array(	'class'	=>	'button submit',
										'value'	=>	'Add Blog Entry'
										));
				echo form_close('');
			?>
		</div>
	</div>
</body>
</html>