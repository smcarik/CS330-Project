<?php

	$dbhost = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'blazinpretzels';
	$used = false;
	$sql = "";

	$conn = new mysqli("$dbhost", "$username", "$password", $db); //connect to database server
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM users";
	$users = $conn->query($sql);
	
	while($row = $users->fetch_assoc()){
		if((strcmp($_POST["user"], $row["username"]) == 0)) {
			$used = true; //if the entered username matches a username in one of the rows of the table, used is set to true
		}
	}
	
	if(!$used){
		$newUsername = $_POST["user"];
		$newPassword = $_POST["pass"];
		$newFirstName = $_POST["fname"];
		$newLastName = $_POST["lname"];
		$sql = "INSERT INTO users (username, password) 
				VALUES ('$newUsername', '$newPassword')";
		$conn->query($sql);
		echo "<link rel=\"stylesheet\" href=\"styles.css\">";
		echo "<h1> Hello, " . $newFirstName . " " . $newLastName . "</h1>";
	}
	else{
		echo "<link rel=\"stylesheet\" href=\"styles.css\">";
		echo "<h1> Invalid username, or username is already in use. Try again please.";
	}
	
	$conn->close();
?>
