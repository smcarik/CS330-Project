<?php
include __DIR__.'\..\Controllers\DBController.php';
include __DIR__.'\..\Projects\projectInfo.php';
$userStory = new UserStoryInfo($_POST['id'],$_POST['asa'],$_POST['iwant'],$_POST['inorderto'],$_POST['accept'],$_POST['size'],$_POST['sprint'],0,NULL,NULL);
try 
{
	$db = new ContactDB();
	$db -> addItemToBacklog($userStory);
	header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
}
catch (PDOException $e)
{
	echo $e;
	header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
}

?>