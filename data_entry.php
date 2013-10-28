<?php
//attempt database connection
$mysqli = new mysqli("localhost", "root","","testify");
if ($mysqli == false) {
	die("Error: Could not connect. " . mysql_connect_error());
} 

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

//add a new record
/**$sql = "INSERT INTO menu (cuisine_name, cuisine_type, cuisine_price, cuisine_option_vegi, cuisine_option_light, cuisine_option_hot, cuisine_option_share) VALUES ('Cottage Pie2','main',5.99,0,0,0,0);";
if ($mysqli->query($sql) == true) {
	echo "New cuisine added ";
} else {
	echo "Error: could not execute $sql. " . $mysqli->error;
}**/
//close connection
$mysqli->close();
?>