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
    $_SESSION['project'] = "none";
    $user = $_SESSION['User']->getUName();
    $db = new ContactDB;
    $projectNames = $db->getAllProjectsForUser($user);
    $pending = $db->viewPending($user);
    echo "<h2> Welcome, $user, to the user home page. </h2>";
    $asshole = $_SESSION['User'];
    if($asshole->getRole() == 1){
    	echo "role: Developer";}
    else {"role: Product Owner";}
    ?>
   <!-- <form method="POST" action="/CS330-Project/ProjectHomePage/projectHomePage.php"> -->
   <h3> Here are the projects that you are a member of: </h3>
	    <table>
		    <?php
		    foreach($projectNames as $proj){?>
		    <form method="POST" action="/CS330-Project/ProjectHomePage/projectHomePage.php">
	    		<tr>
	    			<td><?php echo $proj["projectName"]?></td>
	    			<td><input type="hidden" name="prjName" value=<?php echo "\"".$proj["projectName"]."\""?>></td>
	    			<td><input name="view" value = "View" type="Submit"></td>
	    		</tr>
	    	</form>
	    	<?php
	    	}?>
	    </table>
      <!-- PENDING SHIT -->
      <h3> Here are the projects that you are a pending member of: </h3>
   	    <table>
   		    <?php
   		    foreach($pending as $proj){?>
   	    		<tr>
   	    			<td><?php echo $proj["projectName"]?></td>
       		    <form method="POST" action="/CS330-Project/pending/accept.php">
   	    			<td><input type="hidden" name="prjName" value=<?php echo "\"".$proj["projectName"]."\""?>></td>
   	    			<td><input name="Accept" value = "Accept" type="Submit"></td>
     	    	  </form>
       		    <form method="POST" action="/CS330-Project/pending/reject.php">
   	    			<td><input type="hidden" name="prjName" value=<?php echo "\"".$proj["projectName"]."\""?>></td>
   	    			<td><input name="Reject" value = "Reject" type="Submit"></td>
     	    	  </form>
   	    		</tr>
   	    	<?php
   	    	}?>
   	    </table>
   	<?php if($_SESSION['Role']==0){?>
		<form method="POST" action="\CS330-Project\createProject\createProject.php">
			<input name="Create new Project" value = "Create New Project" type="Submit">
		</form>
	<?php } else{?>
		<form method="POST" action="\CS330-Project\createProject\createProject.php">
			<input name="Create new Project" value = "Create New Project" type="Submit" disabled> Project creation reserved for product owners
		</form>
	<?php }?>
    </body>
</html>
