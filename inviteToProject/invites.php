<!DOCTYPE HTML>
<html>
<head>

 	<title>Invite</title>
 	
 	 <link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Please enter a valid username to invite other members.</h1>
	<?php 
		if($_SESSION['Error'] != "none"){
			echo "Error: ".$_SESSION['Error'];
			$_SESSION['Error'] = "none";
		}
	?>
	<form action="invite_action.php" method="POST">
		<table>
			<tbody>
				<tr>
					<td>UserName:</td>
					<td><input type="text" name="uname" id="UserName"></td>
				</tr>
				<tr>
										<td>Project Name:</td>
					<td><input type="password" name="pw"></td>
				</tr>
			</tbody>		
		</table>		
		<input type="submit" value="Invite">
	</form>
	<p>
	</p>
</body>
</html>
