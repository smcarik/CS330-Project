<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">

<title>Project Home Page</title>
<style>
.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 40%;
    background: #00BFEA;
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
    padding: 2px 16px;
}
</style>
</head>
<body>
	<h1>Project Home Page</h1>
    <?php
				session_start ();
				$_SESSION ['project'] = "" . $_POST ['prjName'] . ""; // create a session variable for the current project
				echo "Project:" . $_SESSION ['project'];
				
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
				<td>
					<form method="POST"
						action="/CS330-Project/CreateUserStory/CreateNewUS.php">
						<input type="Submit" value="create new user story"
							name="create new userstory">
					</form>
				</td>
				<td></td>
				<td><button
						onclick="window.location.href='/../CS330-Project/inviteToProject/invites.php'">Create
						a Task</button></td>
				<td></td>
				<td></td>
			</tr>

		</tbody>

		<div class="card">
			<div class="container">
				<h4>
					<b>John Doe</b>
				</h4>
				<p>Architect & Engineer</p>
			</div>
		</div>
		
	</table>
</body>
</html>