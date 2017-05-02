<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Create task</title>
</head>
    <body>
    	<form action="createNewTasks_Action.php" method="POST">
		<table>
			<tbody>
				<tr>
					<td>USID:</td>
					<td>
					<input type="text" name="usid" value= <?php echo $_POST ['usid']?> readonly>
					</td>
				</tr>
				<tr>
					<td>Description:</td>
					<td>
					<input type="text" name="desc" value= "" >
					</td>
				</tr>
				<tr>
					<td>Sprint:</td>
					<td>
					<input type="text" name="sprint" value= <?php echo $_POST ['sprint']?> readonly>
					</td>
				</tr>
				<tr>
					<td>taskloc:</td>
					<td>
						<input type="text" name="taskloc" value= "0" readonly>
					</td>
				</tr>
				<tr>
					<td>Percent:</td>
					<td><input type="text" name="percent" value ="0" ></td>
				</tr>
				<tr>
					<td>member:</td>
					<td><input type="text" name="member" value ="" ></td>
				</tr>
			</tbody>
		</table>
		<input type="submit" value="Create Task">
	</form>
    </body>

</html>