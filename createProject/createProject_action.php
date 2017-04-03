<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Create Project Action</title>
</head>
    <body>
    
    <?php
   	 	include __DIR__.'\..\Controllers\DBController.php';
    	$projectNameUsed =false;
	    try {
	    	$db = new ContactDB;
	    	$newProjectName = $_POST["projName"];
	    	$newProjectDescription = $_POST["projDesc"];
	    	$added = $db->addIfUnique($newProjectName, $newProjectDescription);
	    	if($added){
	    		echo "Project successfully created!";
	    		?>
	    		<form method="Post" action="CS330-Project/UserHomePage/userHomePage.php"></form>
	    		<?php 
	    		
	    	}
	    }
	    catch(PDOException $e) {
	    	echo "Connection Failed: " . $e->getMessage();
	    }
	?>
    </body>
</html>