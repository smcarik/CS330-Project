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
    			<?php echo $proj["projectName"]?>
    			</td>
    		</tr>
    	<?php
    	}?>
    </table>
	<form method="POST" action="\CS330-Project\createProject\createProject.php">
		<input name="Create new Project" value = "Create new Project" type="Submit">
	</form>
	<button onclick="window.location.href='http://localhost/CS330-Project/inviteToProject/invites.php'">Invite</button>
	
    </body>
</html>

	
	