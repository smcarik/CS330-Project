<?php

	include __DIR__.'/../Controllers/DBController.php';

	try{
		$db = new contactDB;
		$pblid = $db->getfirstidinpbl();
		$success = $db->moveToSprint($_POST['sprintnum'], $pblid);
		if($success){
			header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
		}
		else{
			$_SESSION['Error'] = "Failed to move item to sprint";
			header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
		}
		
	}
	catch(PDOexception $e){
		echo $e;
	}



?>