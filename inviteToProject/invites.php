<!DOCTYPE HTML>
<html>
<head>

 	<title>Invite</title>

 	 <link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Please enter a valid username to invite other members.</h1>
	<?php
		session_start();
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
			</tbody>
		</table>
		<input type="submit" value="Invite">
	</form>
	<form action ="/CS330-Project/UserHomePage/userHomePage.php">
			<input type = "submit" value = "Back">
	</form>
	<p>
	</p>
</body>
</html>
