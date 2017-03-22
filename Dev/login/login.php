<!DOCTYPE HTML>
<?php
if(!isset($_SESSION['Active'])){
	session_start();
	$_SESSION['Active'] = 'Active';
	$_SESSION['Error']=null;
}
?>
<<html>
<head>

 	<title>Login</title>
 	
 	 <link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Welcome to BlazinPretzel's Scrum Board</h1>
	<?php 
	if($_SESSION['Error']!= null){
		echo "Error: " . $_SESSION['Error'];
	}
	?>
	<form action="login_Action.php" method="POST" name="loginform autocomplete="OFF">
		<table>
			<tbody>
				<tr>
					<td>UserName:</td>
					<td><input type="text" name="uid"id="UserName"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="pw"></td>
				</tr>
			</tbody>		
		</table>		
		<input type="submit" value="Login">
	</form>
	<p>
		ENTER YOUR USER NAME & PASSWORD 
		<br>
		<button onclick="window.location='..../Dev2/register/index.html'">Register</button>
	</p>
</body>
</html>
