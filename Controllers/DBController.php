<?php
	include __DIR__.'\..\Users\UserInfo.php';
	session_start();
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
				$success = $this->addUserToProject($_SESSION['User']->getUName(),$newProjectName);
				if($this->getProject($newProjectName) && $success){
					$sql1 = "CREATE TABLE ".$newProjectName."PBL 
							(ID INT NOT NULL DEFAULT 0, 
							ASA LONGTEXT NOT NULL, 
							IWANT LONGTEXT NOT NULL, 
							INORDERTO LONGTEXT NOT NULL, 
							ACCEPT LONGTEXT NOT NULL, 
							SIZE CHAR (1) NOT NULL, 
							SPRINT INT NOT NULL DEFAULT 0,
							DONEPERCENT INT NOT NULL DEFAULT 0,
							APPROVED BOOLEAN DEFAULT NULL,
							REASON LONGTEXT DEFAULT NULL,
							PRIMARY KEY (ID))";
					$dbcon->exec($sql1);
					return true;
				}
			}
			catch(Exception $e){
				return false;
			}
		}
		
		public function updateOrder($position){
			$dbcon = $this->setUpDB();
			if($position == 0){
				$sql0 = "SELECT * FROM ".$_SESSION['project']."PBL";
				foreach($dbcon->query($sql0)as $row){
					$us = new UserStoryInfo($row['ID'],$row['ASA'],$row['IWANT'],$row['INORDERTO'],$row['ACCEPT'],$row['SIZE'],$row['SPRINT']);
					$sqlu = "UPDATE ".$_SESSION['project']."PBL SET ID = ".($us->getid()+1)." WHERE ID = ".$us->getid();
					$dbcon->exec($sqlu);
				}
			}
			else{
				$sql = "Select * from ".$_SESSION['project']."PBL WHERE ID = 0";
				$proj;
				foreach($dbcon->query($sql) as $row){
					$proj = new UserStoryInfo($row['ID'],$row['ASA'],$row['IWANT'],$row['INORDERTO'],$row['ACCEPT'],$row['SIZE'],$row['SPRINT']);
				}
				$proj->setid(9999999999);
				$sql1 = "Select * from ".$_SESSION['project']."PBL where ID<=".$position." && ID>0";
				foreach($dbcon->query($sql1) as $row){
					$pro = new UserStoryInfo($row['ID'],$row['ASA'],$row['IWANT'],$row['INORDERTO'],$row['ACCEPT'],$row['SIZE'],$row['SPRINT']);
					$sqlu = "UPDATE ".$_SESSION['project']."PBL SET ID = ".($pro->getid()-1)." WHERE ID = ".$pro->getid();
					$dbcon->exec($sqlu);
				}
				$proj->setid($position);
				$sqlup = "UPDATE ".$_SESSION['project']."PBL SET ID = ".$proj->getid()." WHERE ID = 9999999999";
				$dbcon->exec($sqlup);
			}
		}
		
		public function addUserToProject($username, $proj){
			$dbcon = $this->setUpDB();
			$sql = "INSERT INTO UserProjectInfo (username, projectName) VALUES ('".$username."', '".$proj."')";
			
			if($this->isProjectMember($username,$proj)){
				$_SESSION['Error'] = "user: ".$username." Is already part of project";
				return false;
			}
			try{
				$dbcon->exec($sql);
				
				if($this->isProjectMember($username,$proj)){
					return true;
				}
				else{
					return false;
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
		
		public function getAllProjectsForUser($user){
			$dbcon = $this->setUpDB();
			$sql = "SELECT * from UserProjectInfo WHERE username = '".$user."'";
			try{
				return $dbcon->query($sql);
			}
			catch(PDOException $e) {
				echo "Connection Failed: " . $e->getMessage();
			}
			return "NONE";
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
			if(!$this->doesUsernameExist($username)){
				$_SESSION['Error'] = "Username: ".$username." does not exist";
				return false;
			}
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
		
		
		public function login($username, $password){
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
		
		public function inviteToProject($username, $proj){
			 $dbcon = $this->setUpDB();
			 
			 if(!$this->isProjectMember($_SESSION['User']->getUName(), $proj)){
			 	$_SESSION['Error'] = "Inviter is not part of project";
			 	return false;
			 }
			 else{
			 	$this->addUserToProject($username,$proj);
			 }
			 
		}
		
		public function addItemToBacklog($us){
			 //$item = array("asa", "iwant", "inorderto", "accept", "size", "sprint");
			 $dbcon = $this->setUpDB();
			 $backlog = $_SESSION['project'] . "PBL";
			 $this -> updateOrder(0);
			 $us->setid(0);
			 $sql = "INSERT INTO ".$backlog." (ID, ASA, IWANT, INORDERTO, ACCEPT, SIZE, SPRINT) VALUES (".$us.getid().", '".$us.getasa()."', '".$us.getiwant()."', '".$us.getinorderto()."', '".$us.getaccept()."', '".$us.getsize()."', ".$us.getsprint().")";
			 $dbcon->exec($sql);
		}
	}
?>