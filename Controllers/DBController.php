<?php
	include __DIR__.'\..\Users\UserInfo.php';
	class ContactDB
	{
		public function __construct(){
			
		}
		protected $dbcon = null;
		
		function setUpDB(){
			try {
				$dbcon = new PDO(
						'mysql:host=devsrv.cs.csbsju.edu;dbname=BlazinPretzels',
						'BlazinPretzels',
						'csci330'
						);
				$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $dbcon;
			}
			catch(PDOException $e)
			{
				$_SESSION['Error'] = 'Failed to connect to Database';
				header('Location: Login.php');
			}
		}
		
		function addIfUnique($newProjectName, $newProjectDescription){ //adds a new project to the project table if the name is unique
			if($newProjectName == null){
				return false;
			}
			$sql = "INSERT INTO ProjectInfo (Name, ProjectDesc) VALUES ('".$newProjectName."', '".$newProjectDescription."')";
			try{
				$dbcon = $this->setUpDB();
				$dbcon->exec($sql);
				if($this->getProject($newProjectName)){
					return true;
				}
			}
			catch(Exception $e){
				return false;
			}
		}
		
		public function getProject($projname){
			$dbcon = $this->setUpDB();
			$sql = "SELECT * from ProjectInfo where Name = '".$projname."'";
			try{
				foreach($dbcon->query($sql) as $row){
					if(strcmp($row['Name'],$projname) == 0){
						return true;
					}
				}
				return false;
			}
			catch(PDOException $e) {
				echo "Connection Failed: " . $e->getMessage();
			}
		}
		
		public function registerUser($fName, $lName, $uName, $pWord)
		{
			$dbcon = $this->setUpDB();
			$taken = false;
			$cnt = 0;
			
			$sql = "SELECT * FROM UserInfo";
			
			try{
				foreach($dbcon->query($sql) as $row) 
				{
					if(strcmp($row["USERNAME"],$uName) == 0) 
					{
						$taken = true;
						break;
					}
					$cnt++;
				}
			
				if(!$taken) 
				{
					$sql = "INSERT INTO UserInfo (FNAME, LNAME, PASSWORD, USERNAME) VALUES ('" . $fName . "', '"  . $lName  . "', '"  . $pWord  . "', '"  . $uName  . "')";
					$dbcon->exec($sql);
					return true;
				}
			}
			catch(PDOException $e) {
				echo "Connection Failed: " . $e->getMessage();
			}
			return false;
			
		}
		
		public function isProjectMember($username, $project){
			$sql = "SELECT * FROM UserProjectInfo";
			try{
				$dbcon = $this->setUpDB();
				foreach($dbcon->query($sql) as $row){
					if(strcmp($row["username"], $username) == 0 && strcmp($row["projectName"], $project) == 0){
						return true;
					}
						
				}
			}
			catch(PDOException $e) {
				echo "Connection Failed: " . $e->getMessage();
			}
			return false;
		}
		
		public function doesUsernameExist($username){
			$dbcon = $this->setUpDB();
			$sql = "SELECT * FROM UserInfo";
			try{
				foreach($dbcon->query($sql) as $row){
					if(strcmp($row["USERNAME"], $username) == 0){
						return true;
					}
			
				}
			}
			catch(PDOException $e) {
				echo "Connection Failed: " . $e->getMessage();
				return false;
			}
			return false;
		}
		
		
		public function logIn($username, $password){
			$dbcon = $this->setUpDB();
			
			$sql = "SELECT * FROM UserInfo";
			$unamegood = $this->doesUsernameExist($username);
			if(!$unamegood){
				$_SESSION['Error']='Invalid Username entered';
				return false;
				//header('Location: CS330/login/login.php');
			}
			else{
				foreach($dbcon->query($sql) as $row){
					if(strcmp($row["PASSWORD"], $password) == 0 && strcmp($row['USERNAME'],$username)==0) {
						$useri = new User($row['FNAME'],$row['LNAME'],$row['USERNAME']);
						$_SESSION['User'] = $useri;
						$_SESSION['Error'] = "none";
						return true;
					}
					else{
						$_SESSION['Error']='Invalid Password entered for '.$username;
						//header('Location: CS330/login/login.php');
					}
				}
				return false;
			}
		}
	}
?>