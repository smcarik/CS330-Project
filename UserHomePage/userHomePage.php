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
    <table>
	    <?php
	    foreach($projectNames as $proj){?>
    		<tr>
    			<td>
    			
    			
    			<!-- Make projects clickable, possibly using href or even create a button to send
    			to project home page, either one works.  next create a hidden field that passes the project name 
    			as a variable.  and upon clicking the project redirect them to projectHomePage.php-->
    			
    			 <a href="/CS330-Project/ProjectHomePage/projectHomePage.php"> <?php echo $proj["projectName"]?></a>
    			</td>
    		</tr>
    	<?php
    	}?>
    </table>
	<form method="POST" action="\CS330-Project\createProject\createProject.php">
		<input name="Create new Project" value = "Create new Project" type="Submit">
	</form>
	<button onclick="window.location.href='/../CS330-Project/inviteToProject/invites.php'">Invite</button>
	
    </body>
</html>

	
	