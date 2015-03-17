<html>
<head>
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

</head>

<body>
<div id="form">
	<form action="checkPHP.php" method="post">
		First Name:<input type="text" name="fName"><br>
		Last Name:<input type="text" name="lName"><br>
		Email: <input type="text" name="email"><br>
		Phone: <input type="text" name="phone"><br>
		Address: <input type="text" name="address"><br>
		City: <input type="text" name="city"><br>
		Zip Code: <input type="text" name="zip"><br>
		State: <select name="state">
		<option value="AL">Alabama</option>
		<option value="AK">Alaska</option>
		<option value="AZ">Arizona</option>
		<option value="AR">Arkansas</option>
		<option value="CA">California</option>
		<option value="CO">Colorado</option>
		<option value="CT">Connecticut</option>
		<option value="DE">Delaware</option>
		<option value="FL">Florida</option>
		<option value="GA">Georgia</option>
		<option value="HI">Hawaii</option>
		<option value="ID">Idaho</option>
		<option value="IL">Illinois</option>
		<option value="IN">Indiana</option>
		<option value="IA">Iowa</option>
		<option value="KS">Kansas</option>
		<option value="KY">Kentucky</option>
		<option value="LA">Louisiana</option>
		<option value="ME">Maine</option>
		<option value="MD">Maryland</option>
		<option value="MA">Massachusetts</option>
		<option value="MI">Michigan</option>
		<option value="MN">Minnesota</option>
		<option value="MS">Mississippi</option>
		<option value="MO">Missouri</option>
		<option value="MT">Montana</option>
		<option value="NE">Nebraska</option>
		<option value="NV">Nevada</option>
		<option value="NH">New Hampshire</option>
		<option value="NJ">New Jersey</option>
		<option value="NM">New Mexico</option>
		<option value="NY">New York</option>
		<option value="NC">North Carolina</option>
		<option value="ND">North Dakota</option>
		<option value="OH">Ohio</option>
		<option value="OK">Oklahoma</option>
		<option value="OR">Oregon</option>
		<option value="PA">Pennsylvania</option>
		<option value="RI">Rhode Island</option>
		<option value="SC">South Carolina</option>
		<option value="SD">South Dakota</option>
		<option value="TN">Tennessee</option>
		<option value="TX">Texas</option>
		<option value="UT">Utah</option>
		<option value="VT">Vermont</option>
		<option value="VA">Virginia</option>
		<option value="WA">Washington</option>
		<option value="WV">West Virginia</option>
		<option value="WI">Wisconsin</option>
		<option value="WY">Wyoming</option>
		</select><br>
		<input type="checkbox" id="citizen" name="citizen">US Citizen?<br>
		Interests:<input type="checkbox" name="sports" value="Sports">Sports<input type="checkbox" name="music" value="Music">Music<input type="checkbox" name="movies" value="Movies">Movies<input type="checkbox" name="instruments" value="Musical Instruments">Musical Instruments<input type="checkbox" name="videogames" value="Video Games">Video Games<input type="checkbox" name="boardgames" value="Board Games">Board Games<input type="checkbox" name="outdoors" value="Outdoors">Outdoors<br>
		Gender: <input type="radio" name="gender" value="Female">Female<input type="radio" name="gender" value="Male">Male<br>
		Year in School: <input type="radio" name="year" value="Freshman">Freshman<input type="radio" name="year" value="Sophomore">Sophomore<input type="radio" name="year" value="Junior">Junior<input type="radio" name="year" value="Senior">Senior<br>
		<input type="submit" id="submit" value="Submit" onclick="">
	</form>
</div>
</body>
</html>