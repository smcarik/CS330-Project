<!doctype html>
<?php
if(!isset($_SESSION)){
	session_start();
	$_SESSION['Error']=null;
}
?>
<html lang="en">
<head>

 	<title>Login</title>
  	<meta name="description" content="Test Login for Project">
  	<meta name="author" content="root" >

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
 	<![endif]-->
 	
 	 <link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Welcome to BlazinPretzel's Scrum Board</h1>
	<?php 
	if($_SESSION['Error']!= null){
		echo "Error: " . $_SESSION['Error'];
	}
	?>
	<form action="Login.php" method="POST" name="loginform autocomplete="OFF">
		<table class="dataentrytable" summary="This data entry table is to be used to format user-login fields">
			<tbody>
				<tr>
					<td class="delabel" scope="row"><label for="UserName"><span class="fieldlabeltext">UserName:</span></label>
					</td>
					<td class="dedefault"><input type="text" name="uid" size="11" maxlength="20" id="UserName">
					</td>
				</tr>
				<tr>
					<td class="delabel" scope="row"><label for="Password"><span class="fieldlabeltext">Password:</span></label>
					</td>
					<td class="dedefault" id="Password"><input type="password" name="pw" size="16" maxlength="20">
					</td>
				</tr>
			</tbody>		
		</table>		
		<input type="submit" value="Login">
	</form>
	<p>
		ENTER YOUR USER NAME & PASSWORD 
		<br>
		<a href="http://www.users.csbsju.edu/%7Emakounniyom/register/register.html">REGISTER HERE!</a>
	</p>
</body>
</html>
