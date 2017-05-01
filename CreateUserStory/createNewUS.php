<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
 	 <link rel="stylesheet" href="styles.css">
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Create User Story</title>
</head>
    <body>
    <?php 
    	session_start();
    	if($_SESSION['Error']!= "none"){
    		echo $_SESSION['Error'];
    		$_SESSION['Error'] = "none";
    	}
    ?>
    	<form action="createNewUS_Action.php" method="POST">
		<table>
			<tbody>
				<tr>
					<td>ID:</td>
					<td><input type="text" name="id" value="0" readonly></td>
				</tr>
				<tr>
					<td>Description:</td>
					<td>As a <input type="text" name="asa">
					I want to/should be able to <input type = "text" name = "iwant">
					in order to <input type="text" name="inorderto"></td>
				</tr>
				<tr>
					<td>Acceptance Criteria:</td>
					<td><input type="text" name="accept"></td>
				</tr>
				<tr>
					<td>Size:</td>
					<td><input type="text" name = "size"></td>
				</tr>
				<tr>
					<td>Location:<br>0:product backlog<br>1:sprint 1<br>etc...</td>
					<td><input type="text" name="sprint" value ="0" readonly></td>
				</tr>
			</tbody>		
		</table>		
		<input type="submit" value="Create">
	</form>
    <?php
		echo $_SESSION['project'];
	?>
    </body>
</frameset>
</html>