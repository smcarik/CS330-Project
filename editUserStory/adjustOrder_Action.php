<?php

	include __DIR__.'\..\Controllers\DBController.php';
	
	try{
		
		$db = new contactDB;
		$lastid = $db->getlastid();
		if($lastid>=$_POST['pos']){
			$succeed = $db->updateOrder($_POST['pos'],$_POST['usid']);
		}
		else{
			$succeed = $db->updateOrder($lastid,$_POST['usid']);
		}
		
		if($succeed){
			header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
		}
		else{
			if($_SESSION['Error']=="none"){
				$_SESSION['Error'] = "Failed to adjust order";
			}
			header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
		}
	}
	catch(PDOexception $e){
		$_SESSION['Error'] = $e;
		header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
	}
	

?>