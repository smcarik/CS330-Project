<?php
include __DIR__.'\..\Controllers\DBController.php';


try
{

	$db = new ContactDB();
	//$succeed = $db -> Matts db Method

	if(strcmp($_POST ['id'],"")==0 || strcmp($_POST ['asa'],"")==0 ||
			strcmp($_POST ['iwantto'],"")==0 || strcmp($_POST ['inorder'],"")==0 ||
			strcmp($_POST ['accpt'],"")==0 || strcmp($_POST ['size'],"")==0){
		$_SESSION['Error'] = "Failed to edit user story.  Input does not match template.";
		header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
	} else {
		$succeed = $db->editUserStory($_POST ['id'], $_POST ['asa'],
			 $_POST ['iwantto'], $_POST ['inorder'],
			 $_POST ['accpt'], $_POST ['size']);
		if($succeed)
		{
			header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
		}
		else{
			$_SESSION['Error'] = " Failed to add item to project";
			header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
		}
	}
	// //remove echos, set this function call equal to variable succeed and continue with checks and redirects.
	// $success = $db->editUserStory($_POST ['id'], $_POST ['asa'],
	// 	 $_POST ['iwantto'], $_POST ['sothat'],
	// 	 $_POST ['acpt'], $_POST ['size']);
	//
	// if($succeed)
	// {
	// 	header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
	// }
	// else{
	// 	$_SESSION['Error'] = " Failed to add item to project";
	// 	header('Location: /CS330-Project/ProjectHomePage/projectHomePage.php');
	// }
}
catch (PDOException $e)
{
	echo $e;
}
?>
