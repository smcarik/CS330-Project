<?php
	include __DIR__.'\..\Controllers\DBController.php';
	try{
		$db = new ContactDB;
		$invited = $db->inviteToProject($_POST["uname"],$_SESSION["project"]);

		if($invited){
			header('Location: /CS330-Project/UserHomePage/userHomePage.php');
		}
		else{
			header('Location: invites.php');
			$_SESSION['Error'] = $_SESSION['Error'] . "<br>Failed to Invite: " . $_POST["uname"] . " to " . $_SESSION["project"];
		}
	}
	catch(PDOException $e) {
		echo "Connection Failed: " . $e->getMessage();
	}


?>
