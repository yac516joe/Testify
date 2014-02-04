<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Register Page</title> 
<link rel="stylesheet" href="./css/jquery.mobile-1.3.1.css">
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>

<body>
	<! -- User Registeration -- >
	<div data-role="page">
		<div data-role="header">
			<a href="index.php" data-rel="back">Home</a>
			<h1>Register Page</h1>
		</div>
		<div data-role="content">	

		<?php
			//attempt connection to MySQL
			$mysqli = new mysqli("localhost", "root","","Tastify");
				if ($mysqli == false) {
					die("Error: Could not connect. " . mysql_connect_error());
				} 

			if (isset($_POST['submit'])) {


				// retrive and check input values
				$inputError = false;
				if (empty($_POST['email'])) {
					echo "Enter valid username";
					$inputError = true;
				} else {
					$email = $mysqli->escape_string($_POST['email']);
				}
				if ($inputError != true && empty($_POST['password'])) {
					echo "Enter valid password plz";
					$inputError = true;
				} else {
					$password = $mysqli->escape_string($_POST['password']);
				}
				if ($inputError != true && empty($_POST['gender'])) {
					echo "Enter valid gender plz";
					$inputError = true;
				} else {
					$gender = $mysqli->escape_string($_POST['gender']);
				}
				if ($inputError != true && empty($_POST['fname'])) {
					echo "Enter valid first name plz";
					$inputError = true;
				} else {
					$fname = $mysqli->escape_string($_POST['fname']);
				}
				if ($inputError != true && empty($_POST['lname'])) {
					echo "Enter valid last name plz";
					$inputError = true;
				} else {
					$lname = $mysqli->escape_string($_POST['lname']);
				}

				$option_vegi = $mysqli->escape_string($_POST['vegi']);
				$option_light = $mysqli->escape_string($_POST['diet']);
				$option_hot = $mysqli->escape_string($_POST['spice']);

				if ($inputError == false) {
					$sql = "INSERT INTO user_db (email,password,gender,fname,lname,option_vegi,option_light,option_hot) 
						VALUES ('$email','$password','$gender','$fname','$lname','$option_vegi','$option_light','$option_hot');";
						
					if ($mysqli->query($sql) == true) {
						echo "New user added with ID: " . $mysqli->insert_id;}
					} else {
						echo "ERROR: $sql. " . $mysqli->error;
					}
				}
					
				//close message block
				echo "</div>";		
			
		?>


			<form method="POST" action=""register.php"" id="registerForm">
			  <div data-role="fieldcontain">
			    <label for="email">User Name:</label>
			    <input type="text" name="email" id="email"   placeholder="At least 5 letters long">
			  </div>
			  <div data-role="fieldcontain">
			    <label for="password">Password:</label>
			    <input type="text" name="password" id="password"   placeholder="At least 5 letters long">
			  </div>
			  <div data-role="fieldcontain">
			    <label for="password2">Confirm Password:</label>
			    <input type="text" name="password2" id="password2"   placeholder="Confirm Your Password">
			  </div>
			  <div data-role="fieldcontain">
			    <label for="fname">First Name: </label>
			    <input type="text" name="fname" id="fname"   placeholder="Your First Name..">
			  </div>
			  <div data-role="fieldcontain">
			    <label for="lname">Last name:</label>
			    <input type="text" name="lname" id="lname"   placeholder="Your Last Name..">
			  </div>
			  <div data-role="fieldcontain">
			    <label for="gender">Your Gender:</label>
			    <select name="gender" id="gender" data-role="slider" >
			      <option value="Male">Male</option>
			      <option value="Female">Female</option>
			    </select>
			  </div>
			  <div data-role="fieldcontain">
		        <fieldset data-role="controlgroup">
		          <legend>Please Tick If You Are </legend>
		            <label for="vegi">A vegi</label>
		            <input type="checkbox" name="vegi" id="vegi" value="1">
		            <label for="diet">On Diet</label>
		            <input type="checkbox" name="diet" id="diet" value="1">
		            <label for="spice">Spicy Food Lover</label>
		            <input type="checkbox" name="spice" id="spice" value="1">	
		        </fieldset>
		      </div>
		      <input type="submit" name="submit" value="Register">
			</form>		
		</div>
	</div>
</body>
</html>
