<head>

<title>Connection</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
$fname = "empty";
$lname = "empty";
$userid = 0;
$bool1 = true;
$bool2 = true;
// Create connection
try {
	$db = new PDO(
			'mysql:host=devsrv.cs.csbsju.edu;dbname=BlazinPretzels',
			'BlazinPretzels',
			'csci330'
			);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM BLAZINPRETZELS_DEMO_DB WHERE USERNAME=\"" . $_POST["uid"] . "\"";

	foreach($db->query($sql) as $row) {
		$bool1 = false;
		if(strcmp($row["PASSWORD"], $_POST["pw"]) == 0) {
			$fname = $row["FNAME"];
			$lname = $row["LNAME"];
			$userid = $row["USERID"];
			$bool2 = false;
		}
	}
}
catch(PDOException $e) {
	echo "Connection Failed: " . $e->getMessage();
}

if($bool1) {
	echo "<h1>Invalid username.</h1>";
} elseif($bool2) {
	echo "<h1>Invalid password.</h1>";
} else {
	echo "<h1> Hello, " . $fname . " " . $lname . ". Welcome Back! </h1>";
	echo "<p>";
	echo "<br> Your account information is as follows!";
	echo "<br> UserID: " . $userid;
	echo "<br> Username: " . $_POST["uid"];
	echo "<br> Password: " . $_POST["pw"];
	echo "<br> First Name: " . $fname;
	echo "<br> Last Name: " . $lname;
	echo "</p>";
}

?>
	<br>
	<button onclick="window.location='index.html'">GO BACK</button>
</body>