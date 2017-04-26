<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
 	 <link rel="stylesheet" href="styles.css">
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">

<title>Project Home Page</title>

</head>
<body>
	<h1>This is a temporary project page, update later to include all
		functionality</h1>
    <?php
				$_SESSION ['project'] = $_POST ['prjName']; // create a session variable for the current project
				echo "Project:". $_SESSION ['project'];
				
				?>
	
	    <table class="dataentrytable" border="1">
		<tbody>
			<tr>
				<td>Product Backlog</td>
				<td>Sprint Backlog</td>
				<td>Tasks To Do</td>
				<td>Tasks In Progress</td>
				<td>Tasks Completed</td>
			</tr>
			<tr>
				<td><button onclick="window.location.href='/../CS330-Project/CreateUserStory/CreateNewUS.php'">Create User Stories</button></td>
				<td> </td>
				<td><button onclick="window.location.href='/../CS330-Project/inviteToProject/invites.php'">Create a Task</button></td>
				<td> </td>
				<td> </td>
			</tr>
			
		</tbody>
	</table>
</body>
</html>