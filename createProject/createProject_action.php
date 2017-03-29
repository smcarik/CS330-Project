<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Create Project Action</title>
</head>
    <body>
    
    <?php
    	$projectNameUsed =false;
	    try {
	    	$db = new ContactDB;
	    	$db->setUpDB();
	    	$newProjectName = $_POST["projName"];
	    	$newProjectDescription = $_POST["projDesc"];
	    	$db->addIfUnique($newProjectName, $newProjectDescription);
	    }
	    catch(PDOException $e) {
	    	echo "Connection Failed: " . $e->getMessage();
	    }
	?>
    </body>
</html>