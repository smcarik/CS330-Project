<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
 	 <link rel="stylesheet" href="styles.css">
 	 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">

<title>Project Home Page</title>
<style>

.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 40%;
    border-radius: 5px;
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
img {
    border-radius: 5px 5px 0 0;
}

.container {
    padding: 2px 16px;
}
</style>
</head>
<body>
	<h1>Project Home Page</h1>
    <?php
    		session_start();
				$_SESSION['project'] = "".$_POST['prjName'].""; // create a session variable for the current project
				echo "Project:". $_SESSION['project'];
				
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
				<td><div class="card">
  					<div class="container">
    				<h4><b>This is a card</b></h4> 
  					</div>
					</div>
				</td>
				<td>
					<div class="w3-container">
					  <h2>Cards</h2>
					  <div class="w3-orange w3-card w3-hover-shadow-yellow-text-blue"><h4>does this work?</h4></div>
					</div>
				</td>
			</tr>
			<tr>
			<td>
				<form method="POST" action="/CS330-Project/CreateUserStory/CreateNewUS.php">
					<input type ="Submit" value="create new userstory" name ="create new userstory">
				</form>
			</td>
				<td> </td>
				<td><button onclick="window.location.href='/../CS330-Project/inviteToProject/invites.php'">Create a Task</button></td>
				<td> </td>
				<td> </td>
			</tr>
			
		</tbody>
	</table>
</body>
</html>