<style>
	#form{
		background-color: gray;
		outline: 10px groove red;
		left:5px;
		top:5px;
		width:700px;
		height: 350px;
		position:relative;
	}
	#submit{
		position: relative;
		left:200px;
		top:20px;
	}
</style>

<div id="form">
	<?php

		echo form_open();//$base_url.'training/project6'); 
		// echo $student_info;
		// echo $states;
		echo form_close();

	?>
	<form action="checkPHP.php" method="post">

		First Name:<input type="text" name="fName"><br>
		Last Name:<input type="text" name="lName"><br>
		Email: <input type="text" name="email"><br>
		Phone: <input type="text" name="phone"><br>
		Address: <input type="text" name="address"><br>
		City: <input type="text" name="city"><br>
		Zip Code: <input type="text" name="zip"><br>
		<label for="state">State:</label>
		<select name="state">
		<?php
		foreach($states as $state)
			echo "<option value=".$state['Abbr'].">".$state['Name']."</option>";
		?>
		
		</select><br>
		<input type="checkbox" id="citizen" name="citizen">US Citizen?<br>
		Interests:<input type="checkbox" name="sports" value="Sports">Sports<input type="checkbox" name="music" value="Music">Music<input type="checkbox" name="movies" value="Movies">Movies<input type="checkbox" name="instruments" value="Musical Instruments">Musical Instruments<input type="checkbox" name="videogames" value="Video Games">Video Games<input type="checkbox" name="boardgames" value="Board Games">Board Games<input type="checkbox" name="outdoors" value="Outdoors">Outdoors<br>
		Gender: <input type="radio" name="gender" value="Female">Female<input type="radio" name="gender" value="Male">Male<br>
		Year in School: <input type="radio" name="year" value="Freshman">Freshman<input type="radio" name="year" value="Sophomore">Sophomore<input type="radio" name="year" value="Junior">Junior<input type="radio" name="year" value="Senior">Senior<br>
		<input type="submit" id="submit" value="Submit" onclick="">
	</form>
</div>