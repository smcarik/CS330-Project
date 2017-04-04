<?php
	include __DIR__.'\..\Controllers\DBController.php';
	try{
		$db = new ContactDB;
		$invited = $db->inviteToProject($_POST["uname"],$_POST["projname"]);
		
		if($invited){
			header('Location: /CS330-Project/UserHomePage/userHomePage.php');
		}
		else{
			header('Location: invites.php');
		}
	}
	catch(PDOException $e) {
		echo "Connection Failed: " . $e->getMessage();
	}
	

?>
