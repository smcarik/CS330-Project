<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Create Project</title>
<link rel="stylesheet" href="styles.css">
</head>
    <body>
    	<div id="Create-Project">
 			<fieldset style = "width: 30%">
 				<h1><legend>Create a New Project!</legend></h1>
 				<form method ="POST" action="createProject_action.php">
 					<table class = "dataentrytable" border="1">
 						<tbody>
 							<tr>
 								<td>Project Name</td>
 								<td>
 									<input type = "text" name = "projName">
 								</td>
 							</tr>
 							<tr>
 								<td>Project Description</td>
 								<td>
 									<input type = "text" name = "projDesc">
 								</td>
 							</tr>
 							<tr>
 								<td>
 									<input value = "Create" name = "Create" type = "submit">
 								</td>
 								<td>
 									<input value = "Reset" name = "Reset" type = "reset">
 								</td>
 							</tr>
 						</tbody>
 					</table>
 				</form>
 			</fieldset>
    	</div>
   <?php 

	?>
    </body>
</html>