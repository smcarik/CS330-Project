<head>

 	<title>Connection</title>
 	 <link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php
		include __DIR__.'\..\Controllers\DBController.php';
		$bool1 = false;
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
			$db->setUpDB();
			/* $db = new PDO(
					'mysql:host=devsrv.cs.csbsju.edu;dbname=BlazinPretzels',
					'BlazinPretzels',
					'csci330'
			);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); */
			$sql = "SELECT * FROM UserInfo";
			$db->registerUser($_POST["fname"],$_POST["lname"],$_POST["user"],$_POST["pass"]);
// 			foreach($db->query($sql) as $row) {
// 				if(strcmp($row["USERNAME"],$_POST["user"]) == 0) {
// 					$bool1 = true;
// 				}
// 				$cnt++;
// 			}

// 			if(!$bool1) {
// 				$sql = "INSERT INTO UserInfo (USERID, FNAME, LNAME, PASSWORD, USERNAME) VALUES (" . $cnt . ", \"" . $_POST["fname"]  . "\", \""  . $_POST["lname"]  . "\", \""  . $_POST["pass"]  . "\", \""  . $_POST["user"]  . "\")";
// 				$db->exec($sql);
// 			}
		} 
		catch(PDOException $e) {
			echo "Connection Failed: " . $e->getMessage();
		}
	 
		if($bool1) {
			echo "<h1>Invalid username.</h1>";	
			echo "<br>";
			echo "<button onclick=\"window.location='register.html'\">GO BACK</button>";
		} else {
			echo "<h1> REGISTRATION SUCCESSFUL!</h1>";	
			echo "<br>";
			echo "<button onclick=\"window.location='../index.html'\">GO TO LOGIN!</button>";	
		} 
	
	?>
	
</body>