<?php
include __DIR__.'\..\Controllers\DBController.php';
try
{
	// TO DO: add checks to make sure fields are not empty, if empty return error to createNewUS page.
	$db = new ContactDB();
	//$succeed = $db -> Matts db Method
	if($succeed)
	{
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