<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Project Home Page</title>
<style>
.card {
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	border-radius: 15px;
	transition: 0.3s;
	width: 100%;
	background: #00BFEA;
}

.card:hover {
	box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
	color: red;
	background: rgba(255, 255, 150, 1)
}

.container {
	padding: 2px 2px;
}
</style>
</head>
<body>
	<h1>Project Home Page</h1>
    <?php
				include __DIR__ . '\..\Controllers\DBController.php';
				// session_start();
				if (isset ( $_POST ['prjName'] )) {
					$_SESSION ['project'] = "" . $_POST ['prjName'] . "";
				}
				// create a session variable for the current project
				
				echo "Project:" . $_SESSION ['project'];
				$db = new ContactDB ();
				$projectPBL = $db->getAllProductBacklogItems ();
				?>
	
	    <table style = "width:75%" class="dataentrytable" border="1">
		<tbody>
			<tr>
				<th>Product Backlog</th>
				<th>Sprint Backlog</th>
				<th>Tasks To Do</th>
				<th>Tasks In Progress</th>
				<th>Tasks Completed</th>
			</tr>
			<tr>
				<td>
					<?php foreach($projectPBL as $pblProj){ ?>
					<div class="card">
						<div class="container">
						<?php echo "ID: ".$pblProj->getid()?>
								<br>
							<?php echo "Size: ".$pblProj->getsize()?>
								<br>
								<br>
								<?php echo "As a ".$pblProj->getasa()." I want to ".$pblProj->getiwant()." so that ".$pblProj->getinorderto()?>
								<br>
								<br>
								<?php echo "Acceptance Criteria: ".$pblProj->getaccept()?>
								<br>
							<form method="POST" action="\CS330-Project\editUserStory\editUserStory.php">
								<input type="hidden" name="ID" value=<?php echo "\"".$pblProj->getid()."\""?>>
								<input type="hidden" name="size" value=<?php echo "\"".$pblProj->getsize()."\""?>>
								<input type="hidden" name="asa" value=<?php echo "\"".$pblProj->getasa()."\""?>>
								<input type="hidden" name="iwantto" value=<?php echo "\"".$pblProj->getiwant()."\""?>>
								<input type="hidden" name="sothat" value=<?php echo "\"".$pblProj->getinorderto()."\""?>>
								<input type="hidden" name="acpt" value=<?php echo "\"".$pblProj->getaccept()."\""?>>
								<input type="hidden" name="acpt" value=<?php echo "\"".$pblProj->getsprint()."\""?>>

									<input name="Edit User Story" value = "Edit User Story" type="Submit">
									</form>
								<br>
						</div>
					</div>
					<p></p>
										<?php } ?>
				</td>

				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<form method="POST"
						action="/CS330-Project/CreateUserStory/CreateNewUS.php">
						<input type="Submit" value="create new userstory"
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
	</table>
</body>
</html>