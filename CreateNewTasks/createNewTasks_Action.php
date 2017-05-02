<?php
	
include __DIR__.'\..\Controllers\DBController.php';

try{
	$db = new contactDB;
	$task = new TaskInfo($_POST['usid'], $_POST['desc'], $_POST['sprint'], $_POST['taskloc'], $_POST['percent'], $_POST['member']);
	$output = $db->addTask($task);
	
	if($output == -2){
		$_SESSION['Error'] = "Percent exceeded 100";
		header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
	}
	elseif($output == 1){
		header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
	}
	else{
		$_SESSION['Error'] = "Failed to add Task";
		header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
	}
}
catch(PDOExcepion $e){
	echo $e;
}

?>