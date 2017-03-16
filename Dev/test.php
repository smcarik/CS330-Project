<?php
	$servername = "localhost";
	$username = "BlazinPretzels";
	$password = "123";
	$dbname = "devtest";
	$fname = "empty"; 
	$lname = "empty";
	$bool = false;

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
   		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM DEVTEST";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()){
			if((strcmp($_POST["uid"], $row["USERNAME"]) == 0) && (strcmp($_POST["pw"], $row["PASS"]) == 0)) {
				$fname = $row["FNAME"];
				$lname = $row["LNAME"];
				$bool	= true;				
			} 
		}
	} 
	echo "<link rel=\"stylesheet\" href=\"styles.css\">";
	if($bool) {
		echo "<h1> Hello, " . $fname . " " . $lname . "</h1>";		
	} else {
		echo "<h1>Invalid username and/or password." . "</h1>";
	}
	$conn->close();
?>
<button onclick="window.location='index.html'">GO BACK</button>
