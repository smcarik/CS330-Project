<head>

 	<title>Connection</title>
 	 <link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php
		include __DIR__.'\..\Controllers\DBController.php';
		$registered = false;
		$cnt = 0;
		if((strcmp("",$_POST["user"]) == 0) or (strcmp("",$_POST["lname"]) == 0) or (strcmp("",$_POST["fname"]) == 0) or (strcmp("",$_POST["pass"]) == 0)) {
			echo "<h1>Empty Field.</h1>";	
			echo "<br>";
			echo "<button onclick=\"window.location='register.html'\">GO BACK</button>";
			die();
		} 
		// Create connection
		try { 
			$db = new ContactDB;
			$sql = "SELECT * FROM UserInfo";
			$registered = $db->registerUser($_POST["fname"],$_POST["lname"],$_POST["user"],$_POST["pass"]);
		} 
		catch(PDOException $e) {
			echo "Connection Failed: " . $e->getMessage();
		}
	 
		if(!$registered) {
			echo "<h1>Invalid username.</h1>";	
			echo "<br>";
			echo "<button onclick=\"window.location='register.html'\">GO BACK</button>";
		} else if($registered){
			echo "<h1> REGISTRATION SUCCESSFUL!</h1>";
			echo "<br>"
	?>
			<form method="Post" action ="/../CS330-Project/login/login.php">
				<input type="submit" value="Go to Login!">
			</form>
	<?php	
			echo "<br>";
			//echo "<button onclick=\"window.location='/CS330-Project/login/login.php'\">GO TO LOGIN!</button>";	
		} 
		else{
			echo "An unknown error has occured please try again";
	?>
			<form method="Post" action ="/register.html">
				<input type="submit" value="Go back to register">
			</form>
	<?php 
		}
	
	?>
	
</body>