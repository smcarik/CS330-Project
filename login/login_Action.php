<!DOCTYPE HTML> 
<html> 
<head>
	<title>Login</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
session_start();

//include __DIR__.'\..\Users\UserInfo.php';
include __DIR__.'\..\Controllers\DBController.php';


$fname = "empty";
$lname = "empty";
$userid = 0;
$loggedin = false;
// Create connection
try {
	$db = new ContactDB();
	$loggedIn = $db->login($_POST['uid'],$_POST['pw']);
}
catch(PDOException $e){
	$_SESSION['Error'] = 'Failed to connect to Database';
	header('Location: Login.php');
	//echo "Connection Failed: " . $e->getMessage();
}

if($loggedIn){
	//echo $_SESSION['User']->getUName();
	$_SESSION['LoggedIn'] = true;
	header('Location: /CS330-Project/UserHomePage/userHomePage.php');
	
}
else{
	header('Location: Login.php');
}
/* if($bool1) {
	echo "<h1>Invalid username.</h1>";
} 
elseif($bool2) {
	echo "<h1>Invalid password.</h1>";
} 
else {
	header('Location: /CS330-Project/UserHomePage/userHomePage.php');
	 echo "<h1> Hello, " . $fname . " " . $lname . ". Welcome Back! </h1>";
	echo "<p>";
	echo "<br> Your account information is as follows!";
	echo "<br> UserID: " . $userid;
	echo "<br> Username: " . $_POST["uid"];
	echo "<br> Password: " . $_POST["pw"];
	echo "<br> First Name: " . $fname;
	echo "<br> Last Name: " . $lname;
	echo "</p>"; 
} */

?>
	<br>
	<button onclick="window.location='login.php'">GO BACK</button>
</body>
</html>
