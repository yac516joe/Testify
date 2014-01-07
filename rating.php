<html>
<head>

</head>

<body> 
	<h3>Add New Rating</h3>
	<?php
	// if form submitted
	//process form input
	if (isset($_POST['submit'])) {
		//attempt connection to MySQL
		$mysqli = new mysqli("localhost", "root","","Tastify");
		if ($mysqli == false) {
			die("Error: Could not connect. " . mysql_connect_error());
		} else {
			echo "Connection Success";
		}

		//open message block
		echo '<div id="message">';

		// retrive and check input values
		$inputError = false;
		if (empty($_POST['user_id'])) {
			echo "Enter valid userid";
			$inputError = true;
		} else {
			$user_id = $mysqli->escape_string($_POST['user_id']);
		}
		if ($inputError != true && empty($_POST['cuisine_id'])) {
			echo "Enter valid cuisine id plz";
			$inputError = true;
		} else {
			$cuisine_id = $mysqli->escape_string($_POST['cuisine_id']);
		}
		if ($inputError != true && empty($_POST['rating'])) {
			echo "Enter valid rating plz";
			$inputError = true;
		} else {
			$rating = $mysqli->escape_string($_POST['rating']);
		}
		

		$sql = "INSERT INTO rating_db (user_id,cuisine_id,rating) 
			VALUES ($user_id, $cuisine_id, $rating);";

		if ($mysqli->query($sql) == true) {
			echo "New rating added with ID: " . $mysqli->insert_id;
		} else {
			echo "ERROR: $sql. " . $mysqli->error;
		}

		//close message block
		echo "</div>";

		
	}
	?>

	</div>

	<form action="rating.php" method="POST">
		user id <br \>
		<input type="text" name="user_id" size="40" />
		<p />
		cuisine id <br \>
		<input type="text" name="cuisine_id" size="40" />
		<p />
		rating<br \>
		<input type="text" name="rating" size="40" />
		<p />
		
		<input type="submit" name="submit" value="Submit" />
	</form>

	<?php
	//Attempy query execution
	$sql = "select * from rating_db";
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