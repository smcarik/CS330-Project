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
	<form action="login_Action.php" method="POST">
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
	<form action="http://www.users.csbsju.edu/~makounniyom/Dev2/register/register.html">
		<input type="submit" value="Register">
	</form>
	<p>
		ENTER YOUR USER NAME & PASSWORD 
		<br>
	</p>
</body>
</html>
