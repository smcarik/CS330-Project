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
    <?php
    include __DIR__.'\..\Controllers\DBController.php';
    //session_start();
    if(isset($_POST['prjName']))
    {
    	$_SESSION['project'] = "".$_POST['prjName']."";
    }
    // create a session variable for the current project

	echo "<h1> Project: ". $_SESSION['project']."</h1>";
	if($_SESSION['Error']!= "none"){
		echo $_SESSION['Error'];
		$_SESSION['Error'] = "none";
	}
	$db = new ContactDB;
	$projectPBL = $db->getAllProductBacklogItems();
	$numSprints = $db->getNumberOfSprints();
				?>

	    <table class="dataentrytable" border="1">
		<tbody>
			<tr>
				<td>Product Backlog</td>
				<?php if($numSprints==0){
					$numSprints=1;
				}
					for($i =1; $i<=$numSprints; $i++){
						 echo "<td>Sprint #".$i. " Backlog</td>";
						}?>
				<td>Tasks To Do</td>
				<td>Tasks In Progress</td>
				<td>Tasks Completed</td>
			</tr>
			<tr>
				<td valign = "top">
					<?php
					foreach($projectPBL as $pblProj){
						if($pblProj->getsprint()==0){
						?>
						<div class="card">
							<div class="container">
								<?php echo "ID: ".$pblProj->getid();?>
								<br><br>
								<?php echo "Size: ".$pblProj->getsize();?>
									<br><br>
									<?php echo "As a ".$pblProj->getasa()." I want to ".$pblProj->getiwant()." so that ".$pblProj->getinorderto();?>
									<br><br>
									<?php echo "Acceptance Criteria: ".$pblProj->getaccept();
										if($_SESSION['Role']==0){
									?><br><br>
									<form method="POST" action="/CS330-Project/editUserStory/editUserStory.php">
							    			<input type="hidden" name="ID" value=<?php echo "\"".$pblProj->getid()."\""?>>
							    			<input type="hidden" name="asa" value=<?php echo "\"".$pblProj->getasa()."\""?>>
							    			<input type="hidden" name="iwantto" value=<?php echo "\"".$pblProj->getiwant()."\""?>>
							    			<input type="hidden" name="inorder" value=<?php echo "\"".$pblProj->getinorderto()."\""?>>
							    			<input type="hidden" name="accpt" value=<?php echo "\"".$pblProj->getaccept()."\""?>>
							    			<input type="hidden" name="size" value=<?php echo "\"".$pblProj->getsize()."\""?>>
							    			<input name="Edit" value="Edit" type="Submit">
		    						</form>
									<form method = "post" action = "/CS330-Project/editUserStory/adjustOrder_Action.php">
										<input type = "text" name ="pos" value = "enter position">
										<input type = "hidden" name ="usid" value = <?php echo "\"".$pblProj->getid()."\""?>>
										<input type = "Submit" Value ="Move Item">
									</form>
									<?php }?>
								</div>
							</div>
						<p></p>
					<?php }} ?>
				</td>
				<?php
					for($i =1; $i<=$numSprints; $i++){?>
						<td valign ="top">
						<?php foreach($projectPBL as $pblProj){

							if($pblProj->getSprint()==$i){?>

							<div class="card">
								<div class="container">
									<?php echo "ID: ".$pblProj->getid();?>
									<br><br>
									<?php echo "Size: ".$pblProj->getsize();?>
										<br><br>
										<?php echo "As a ".$pblProj->getasa()." I want to ".$pblProj->getiwant()." so that ".$pblProj->getinorderto();?>
										<br><br>
										<?php echo "Acceptance Criteria: ".$pblProj->getaccept();
											if($_SESSION['Role']==0) {
										?>
										<br><br>
										<form method="POST" action="/CS330-Project/editUserStory/editUserStory.php">
								    			<input type="hidden" name="ID" value=<?php echo "\"".$pblProj->getid()."\""?>>
								    			<input type="hidden" name="asa" value=<?php echo "\"".$pblProj->getasa()."\""?>>
								    			<input type="hidden" name="iwantto" value=<?php echo "\"".$pblProj->getiwant()."\""?>>
								    			<input type="hidden" name="inorder" value=<?php echo "\"".$pblProj->getinorderto()."\""?>>
								    			<input type="hidden" name="accpt" value=<?php echo "\"".$pblProj->getaccept()."\""?>>
								    			<input type="hidden" name="size" value=<?php echo "\"".$pblProj->getsize()."\""?>>
								    			<input name="Edit" value="Edit" type="Submit">
			    						</form>
			    						<?php } if($_SESSION['Role'] == 1){?>
			    							<br>
			    							<form method = "POST" action = "/CS330-Project/CreateNewTasks/CreateNewTask.php">
			    								<input type = "hidden" name = "usid" value = <?php echo "\"".$pblProj->getid()."\""?>>
			    								<input type = "hidden" name = "sprint" value = <?php echo "\"".$pblProj->getsprint()."\""?>>
			    								<input type = "Submit" value = "Create Task for User Story">
			    							</form>
			    						
			    						<?php }?>

								</div>
							</div>
							<?php
								}?>
						<p></p>
					<?php } ?>
						</td>
				<?php }?>
				<!-- Section for tasks -->
				<?php
					$tasklist = $db->getTasks();
					for($i =1; $i<=$numSprints; $i++){?>
						<td valign ="top">
						<?php foreach($tasklist as $task){

							if($task['SPRINT']==$i){ ?>

							<div class="card">
								<div class="container">
									<?php echo "Task ID: ".$task['USID']."-".$task['TID'];?>
									<br><br>
									<?php echo "Description: ".$task['DESCRIPTION'];?>
										<br><br>
										<?php if($task['TASKLOC']==0){echo "Task status: TO DO";}
											elseif($task['TASKLOC']==1){echo "Task status: IN PROGRESS";}
											else{echo "Task status: COMPLETED";}
										?>
										<br><br>
										<?php echo "Percent: ".$task['PERCENT'];?>
										<br><br>
										
			    						<?php echo "Member: ".$task['MEMBER'];?>
			    						<br>
								</div>
							</div>
							<?php
								}?>
						<p></p>
					<?php } ?>
						</td>
				<?php }?>
				<!-- Section for tasks -->
			</tr>
			
			
				
			<tr>
				<td>
				<?php if($_SESSION['Role']==0){?>
					<form method="POST"
						action="/CS330-Project/CreateUserStory/CreateNewUS.php">
						<input type="Submit" value="create new user story"
							name="create new user story">
					</form>
				<?php } else { ?>
					<form method="POST"
						action="/CS330-Project/CreateUserStory/CreateNewUS.php">
						<input type="Submit" value="create new user story" name="create new user story" disabled>
						<br>Creation of User Stories reserved for Product Owners
					</form>
					<?php }?>
				</td>
				<?php for($j =1; $j<=$numSprints; $j++){?>
				<td>
				<?php if($_SESSION['Role']==1){?>
					<form method = "POST" action = "/CS330-Project/MoveItemsToSprints/moveItemToSBL.php">
						<input type = "hidden" name = "sprintnum" value = <?php echo "\"".$j."\""?>>
						<input type = "Submit" value = "Pull item from pbl">
					</form>
				<?php } else {?>
					<form method = "POST" action = "/CS330-Project/MoveItemsToSprints/moveItemToSBL.php">
						<input type = "hidden" name = "sprintnum" value = <?php echo "\"".$j."\""?>>
						<input type = "Submit" value = "Pull item from pbl" disabled>
						<br>Developers may only commit Items to sprints
					</form>
				<?php }?>
				</td>
				<?php }?>
				<td><button onclick="window.location.href='/../CS330-Project/inviteToProject/invites.php'">Invite User to Project</button></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<button onclick="window.location.href='/../CS330-Project/UserHomePage/userHomePage.php'">Back</button>
	<?php echo $db->gettotalpercent(1);?>
</body>
</html>
