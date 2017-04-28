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
	width: 60%;
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
    <?php
    include __DIR__.'\..\Controllers\DBController.php';
    //session_start();
    if(isset($_POST['prjName']))
    {
    	$_SESSION['project'] = "".$_POST['prjName']."";
    }
    // create a session variable for the current project

	echo "<h1> Project: ". $_SESSION['project']."</h1>";
	$db = new ContactDB;
	$projectPBL = $db->getAllProductBacklogItems();
	$numSprints = $db->getNumberOfSprints();
				?>
	
	    <table class="dataentrytable" border="1">
		<tbody>
			<tr>
				<td>Product Backlog</td>
				<?php for($i =0; $i<$numSprints; $i++){
						 echo "<td>Sprint".$i. "Backlog</td>";
						}?>
				<td>Tasks To Do</td>
				<td>Tasks In Progress</td>
				<td>Tasks Completed</td>
			</tr>
			<tr>
				<td>
					<?php foreach($projectPBL as $pblProj){ ?>
						<div class="card">
							<div class="container">
								<?php echo "ID: ".$pblProj->getid();?>
								<br>
								<?php echo "Size: ".$pblProj->getsize()?>
									<br>
									<?php echo "As a ".$pblProj->getasa()." I want to ".$pblProj->getiwant()." so that ".$pblProj->getinorderto()?>
									<br>
									<?php echo "Acceptance Criteria: ".$pblProj->getaccept()?>
									<form method="POST" action="/CS330-Project/editUserStory/editUserStory.php">
							    			<input type="hidden" name="ID" value=<?php echo "\"".$pblProj->getid()."\""?>>
							    			<input type="hidden" name="asa" value=<?php echo "\"".$pblProj->getasa()."\""?>>
							    			<input type="hidden" name="iwantto" value=<?php echo "\"".$pblProj->getiwant()."\""?>>
							    			<input type="hidden" name="sothat" value=<?php echo "\"".$pblProj->getinorderto()."\""?>>
							    			<input type="hidden" name="acpt" value=<?php echo "\"".$pblProj->getaccept()."\""?>>
							    			<input type="hidden" name="size" value=<?php echo "\"".$pblProj->getsize()."\""?>>
							    			<input name="Edit" value="Edit" type="Submit">
		    						</form>								
									<?php if($pblProj->getid()==0){?>
										<form method = "post" action = "/CS330-Project/editUserStory/adjustOrder_Action.php">
											<input type = "text" name ="pos" value = "enter position">
											<input type = "Submit" Value ="Move Item">
										</form>
									<?php } ?>
								</div>
							</div>
						<p></p>
					<?php } ?>
				</td>
				<td>
					<?php foreach($projectPBL as $pblProj){ ?>
						
						<div class="card">
							<div class="container">
								<?php echo "ID: ".$pblProj->getid();?>
								<br>
								<?php echo "Size: ".$pblProj->getsize()?>
									<br>
									<?php echo "As a ".$pblProj->getasa()." I want to ".$pblProj->getiwant()." so that ".$pblProj->getinorderto()?>
									<br>
									<?php echo "Acceptance Criteria: ".$pblProj->getaccept()?>
									<form method="POST" action="/CS330-Project/editUserStory/editUserStory.php">
							    			<input type="hidden" name="ID" value=<?php echo "\"".$pblProj->getid()."\""?>>
							    			<input type="hidden" name="asa" value=<?php echo "\"".$pblProj->getasa()."\""?>>
							    			<input type="hidden" name="iwantto" value=<?php echo "\"".$pblProj->getiwant()."\""?>>
							    			<input type="hidden" name="sothat" value=<?php echo "\"".$pblProj->getinorderto()."\""?>>
							    			<input type="hidden" name="acpt" value=<?php echo "\"".$pblProj->getaccept()."\""?>>
							    			<input type="hidden" name="size" value=<?php echo "\"".$pblProj->getsize()."\""?>>
							    			<input name="Edit" value="Edit" type="Submit">
		    						</form>								
									<?php if($pblProj->getid()==0){?>
										<form method = "post" action = "/CS330-Project/editUserStory/adjustOrder_Action.php">
											<input type = "text" name ="pos" value = "enter position">
											<input type = "Submit" Value ="Move Item">
										</form>
									<?php } ?>
								</div>
							</div>
						<p></p>
					<?php } ?>
				</td>
				
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
				<td><button onclick="window.location.href='/../CS330-Project/inviteToProject/invites.php">Invite User to Project</button></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<button onclick="window.location.href='/../CS330-Project/UserHomePage/userHomePage.php'">Back</button>
	<?php
    	if($_SESSION['Error']!= "none"){
    		echo $_SESSION['Error'];
    		$_SESSION['Error'] = "none";
    	}
    ?>
</body>
</html>
