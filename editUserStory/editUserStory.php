<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
 	 <link rel="stylesheet" href="styles.css">
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Create User Story</title>
</head>
    <body>
    	<form action="editUserStory_Action.php" method="POST">
		<table>
			<tbody>
				<tr>
					<td>ID:</td>
					<td>
					<input type="text" name="id" value= <?php echo $_POST ['ID']?> readonly>
					</td>
				</tr>
				<tr>
					<td>Description:</td>
					<td>As a
					<input type="text" name="asa" value= <?php echo $_POST ['asa']?> >

					I want to/should be able to

					<input type="text" name="iwantto" value= <?php echo $_POST ['iwantto']?> >

					in order to
					<input type="text" name="inorder" value= <?php echo $_POST ['inorder']?> >

					</td>
				</tr>
				<tr>
					<td>Acceptance Criteria:</td>
					<td>
					<input type="text" name="accpt" value= <?php echo $_POST ['accpt']?> >
					</td>
				</tr>
				<tr>
					<td>Size:</td>
					<td>
						<input type="text" name="size" value= <?php echo $_POST ['size']?> >
					</td>
				</tr>
				<tr>
					<td>Location:<br>0:product backlog<br>1:sprint 1<br>etc...</td>
					<td><input type="text" name="sprint" value ="0" readonly></td>
				</tr>
			</tbody>
		</table>
		<input type="submit" value="Edit">
	</form>
    </body>
</frameset>
</html>
