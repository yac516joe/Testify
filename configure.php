<html>
<head>

</head>

<body>
	<h3>Add New Cuisine</h3>
	<?php
	// if form submitted
	//process form input
	if (isset($_POST['submit'])) {
		//attempt connection to MySQL
		$mysqli = new mysqli("localhost", "root","","testify");
		if ($mysqli == false) {
			die("Error: Could not connect. " . mysql_connect_error());
		} else {
			echo "Connection Success";
		}

		//open message block
		echo '<div id="message">';

		// retrive and check input values
		$inputError = false;
		if (empty($_POST['cuisine_name'])) {
			echo "Enter valid name plz";
			$inputError = true;
		} else {
			$name = $mysqli->escape_string($_POST['cuisine_name']);
		}
		if ($inputError != true && empty($_POST['cuisine_type'])) {
			echo "Enter valid name plz";
			$inputError = true;
		} else {
			$type = $mysqli->escape_string($_POST['cuisine_type']);
		}
		if ($inputError != true && empty($_POST['cuisine_price'])) {
			echo "Enter valid name plz";
			$inputError = true;
		} else {
			$price = $mysqli->escape_string($_POST['cuisine_price']);
		}
		if ($inputError != true && empty($_POST['cuisine_option_vegi'])) {
			echo "Enter valid name plz";
			$inputError = true;
		} else {
			$vegi = $mysqli->escape_string($_POST['cuisine_option_vegi']);
		}
		if ($inputError != true && empty($_POST['cuisine_option_light'])) {
			echo "Enter valid name plz";
			$inputError = true;
		} else {
			$light = $mysqli->escape_string($_POST['cuisine_option_light']);
		}
		if ($inputError != true && empty($_POST['cuisine_option_hot'])) {
			echo "Enter valid name plz";
			$inputError = true;
		} else {
			$hot = $mysqli->escape_string($_POST['cuisine_option_hot']);
		}
		if ($inputError != true && empty($_POST['cuisine_option_share'])) {
			echo "Enter valid name plz";
			$inputError = true;
		} else {
			$share = $mysqli->escape_string($_POST['cuisine_option_share']);
		}
		

		$sql = "INSERT INTO menu (cuisine_name, cuisine_type, cuisine_price, cuisine_option_vegi, cuisine_option_light, cuisine_option_hot, cuisine_option_share) 
			VALUES ('$name','$type',$price,$vegi,$light,$hot,$share);";

		if ($mysqli->query($sql) == true) {
			echo "New cuisine added with ID: " . $mysqli->insert_id;
		} else {
			echo "ERROR: $sql. " . $mysqli->error;
		}

		//close message block
		echo "</div>";

		
	}
	?>

	</div>

	<form action="configure.php" method="POST">
		Cuisine Name <br \>
		<input type="text" name="cuisine_name" size="40" />
		<p />
		Cuisine Type <br \>
		<input type="text" name="cuisine_type" size="40" />
		<p />
		Cuisine Price £<br \>
		<input type="text" name="cuisine_price" size="40" />
		<p />
		Vegi?      <br \>
		<input type="text" name="cuisine_option_vegi" size="40" />
		<p />
		Light?<br \>
		<input type="text" name="cuisine_option_light" size="40" />
		<p />
		Hot? <br \>
		<input type="text" name="cuisine_option_hot" size="40" />
		<p />
		Share? <br \>
		<input type="text" name="cuisine_option_share" size="40" />
		<p />
		<input type="submit" name="submit" value="Submit" />
	</form>

	<?php
	//Attempy query execution
	$sql = "select * from menu";
	if ($result = $mysqli->query($sql)) {
		if ($result->num_rows > 0) {
			while($row = $result->fetch_array()) {
				echo $row[0] . " " . $row[1] . " "  . $row[2] . " "  . $row[3] . "<br>";
			}
			$result->close();
		} else {
			echo "No reords matching your query were found.";
		}
	} else {
		echo "Error: could not execute $sql. " . $mysqli->error;
	}

	//close connection
	$mysqli->close() ;
	?>

</body>
</html>