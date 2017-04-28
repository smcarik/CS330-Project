<?php
include __DIR__.'\..\Controllers\DBController.php';
$userStory = new UserStoryInfo($_POST['id'],$_POST['asa'],$_POST['iwant'],$_POST['inorderto'],$_POST['accept'],$_POST['size'],$_POST['sprint'],0,NULL,NULL);
try 
{
	// TO DO: add checks to make sure fields are not empty, if empty return error to createNewUS page.
	$db = new ContactDB();
	$succeed = $db -> addItemToBacklog($userStory);
	if($succeed){
		header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
	}
	else{
		$_SESSION['Error'] = " Failed to add item to project";
		header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
	}
}
catch (PDOException $e)
{
	echo $e;
}

?>