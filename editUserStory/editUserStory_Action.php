<?php
include __DIR__.'\..\Controllers\DBController.php';
include __DIR__.'/../ProjectHomePage/projectHomePage.php';


try
{
	// TO DO: add checks to make sure fields are not empty, if empty return error to createNewUS page.
	$db = new ContactDB();
	//$succeed = $db -> Matts db Method
	
	if(strcmp(echo $_POST ['id'],"")==0, strcmp(echo $_POST ['asa'],"")==0,
			strcmp(echo $_POST ['iwantto'],"")==0, strcmp(echo $_POST ['sothat'],"")==0,
			strcmp(echo $_POST ['acpt'],"")==0, strcmp(echo $_POST ['size'],"")==0){
		
	}
	
	$db->editUserStory(echo $_POST ['id'], echo $_POST ['asa'],
			echo $_POST ['iwantto'], echo $_POST ['sothat'],
			echo $_POST ['acpt'], echo $_POST ['size']);
	
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