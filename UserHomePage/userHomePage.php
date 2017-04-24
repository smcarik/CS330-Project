<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<link rel="stylesheet" href="styles.css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>User Home Page</title>
</head>

    <body>
    <?php   
    include __DIR__.'\..\Controllers\DBController.php';
    //session_start();
    $user = $_SESSION['User']->getUName();
    $db = new ContactDB;
    $projectNames = $db->getAllProjectsForUser($user);
    echo "Welcome, $user, to the user home page. Here are the projects that you are a member of:"
    ?>
    <form method="POST" action="/CS330-Project/ProjectHomePage/projectHomePage.php">
    	<input>
	    <table>
		    <?php
		    foreach($projectNames as $proj){?>
	    		<tr>
	    			<td><?php echo $proj["projectName"]?></td> //print out each project name
	    			<td><input type="hidden" name="prjName" value=<?php echo $proj["projectName"]?>></td> //create a hidden field value for each respective project name
	    			<td><input name="view" value = "view" type="Submit"></td> //create a view button for each project
	    		</tr>
	    	<?php
	    	}?>
	    </table>
    </form>
	<form method="POST" action="\CS330-Project\createProject\createProject.php">
		<input name="Create new Project" value = "Create new Project" type="Submit">
	</form>
	<button onclick="window.location.href='/../CS330-Project/inviteToProject/invites.php'">Invite</button>
	
    </body>
</html>

	
	