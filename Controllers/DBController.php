<?php
	include __DIR__.'\..\Users\UserInfo.php';
	include __DIR__.'\..\Projects\projectinfo.php';
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
				$success = $this->addUserToProject($_SESSION['User']->getUName(),$newProjectName, 1);
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
							APPROVED BOOLEAN DEFAULT FALSE,
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

		public function updateOrder($position, $usid){
			$dbcon = $this->setUpDB();
			$proj;
			//this if statement is for newly created User stories, takes all items in pbl and decrements then inserts new item.
			if($usid == 9999998){
				$sql0 = "SELECT * FROM ".$_SESSION['project']."PBL where ID>=".$position." order by ID desc";
				foreach($dbcon->query($sql0)as $row){
					$us = new UserStoryInfo($row['ID'],$row['ASA'],$row['IWANT'],$row['INORDERTO'],$row['ACCEPT'],$row['SIZE'],$row['SPRINT'],$row['DONEPERCENT'],$row['APPROVED'],$row['REASON']);
					$sqlu = "UPDATE ".$_SESSION['project']."PBL SET ID = ".($us->getid()+1)." WHERE ID = ".$us->getid();
					$dbcon->exec($sqlu);
				}
			}
			// this section is for if a user tries to move user story up, we are not allowing that right now
			elseif($position<=$usid){
				$_SESSION['Error'] = "Invalid location entered. Tip: you cannot move items up.";
				return false;
			}
			//this section handles moving a user in the product backlog down to a new location
			else{
				$sql = "Select * from ".$_SESSION['project']."PBL WHERE ID = ".$usid;
				foreach($dbcon->query($sql) as $row){
					$proj = new UserStoryInfo($row['ID'],$row['ASA'],$row['IWANT'],$row['INORDERTO'],$row['ACCEPT'],$row['SIZE'],$row['SPRINT'],$row['DONEPERCENT'],$row['APPROVED'],$row['REASON']);
					$dbcon->exec("UPDATE ".$_SESSION['project']."PBL SET ID = 9999999 WHERE ID = ".$proj->getid());
				}
					$sql1 = "Select * from ".$_SESSION['project']."PBL where ID<=".$position." && ID>".$usid;
					foreach($dbcon->query($sql1) as $row){
						$pro = new UserStoryInfo($row['ID'],$row['ASA'],$row['IWANT'],$row['INORDERTO'],$row['ACCEPT'],$row['SIZE'],$row['SPRINT'],$row['DONEPERCENT'],$row['APPROVED'],$row['REASON']);
						$sqlu = "UPDATE ".$_SESSION['project']."PBL SET ID = ".($pro->getid()-1)." WHERE ID = ".$pro->getid();
						$dbcon->exec($sqlu);
					}
					$sqlup = "UPDATE ".$_SESSION['project']."PBL SET ID = ".$position." WHERE ID = 9999999";
					$dbcon->exec($sqlup);
				//this section moves items up, commented out to prevent having items in sprint backlogs
				// that have lower ids then in product backlog
				/* elseif($position < $usid){
					$sql2 = "SELECT * FROM ".$_SESSION['project']."PBL WHERE ID<".$usid." $$ ID>=".$position." order by ID desc";
					foreach($dbcon->query($sql2) as $row){
						$pro = new UserStoryInfo($row['ID'],$row['ASA'],$row['IWANT'],$row['INORDERTO'],$row['ACCEPT'],$row['SIZE'],$row['SPRINT'],$row['DONEPERCENT'],$row['APPROVED'],$row['REASON']);
						$sqlu1 = "UPDATE ".$_SESSION['project']."PBL SET ID = ".($pro->getid()+1)." WHERE ID = ".$pro->getid();
						$dbcon->exec($sqlu1);
					}
					$sqlup = "UPDATE ".$_SESSION['project']."PBL SET ID = ".$position." WHERE ID = 9999999";
					$dbcon->exec($sqlup);
				} */
			}
			foreach($dbcon->query("Select * from ".$_SESSION['project']."PBL where id =".$position)as $row)
			{
				if($row['ASA']==$proj->getasa()&&$row['IWANT']==$proj->getiwant()&&$row['INORDERTO']==$proj->getinorderto()){
					return true;
				}
				else{
					return false;
				}
			}
		}


		public function getlastid(){
			$dbcon=$this->setUpDB();
			$sql = "Select * from ".$_SESSION['project']."PBL order by ID desc";
			foreach($dbcon->query($sql)as $row){
				return $row['ID'];
			}
		}

		public function getfirstidinpbl(){
			$dbcon = $this->setUpDB();
			$sql = "SELECT * FROM ". $_SESSION['project']."PBL WHERE SPRINT = 0 order by id asc";
			foreach($dbcon->query($sql) as $row){
				return $row['ID'];
			}
		}

		public function getNumberOfSprints(){
			$dbcon=$this->setUpDB();
			$sql = "Select * from ".$_SESSION['project']."PBL order by SPRINT desc";
			foreach($dbcon->query($sql)as $row){
				return $row['SPRINT'];
			}
		}

		public function getNumOfColsForProj(){
			return $this->getNumberOfSprints()+1+3;
		}

		public function addUserToProject($username, $proj, $accept){
			$dbcon = $this->setUpDB();
			$sql = "INSERT INTO UserProjectInfo (username, projectName, accept) VALUES ('".$username."', '".$proj."',". $accept .")";

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
			$sql = "SELECT * from UserProjectInfo WHERE username = '".$user."' AND ACCEPT=1";
			try{
				return $dbcon->query($sql);
			}
			catch(PDOException $e) {
				echo "Connection Failed: " . $e->getMessage();
			}
			return "NONE";
		}

		public function registerUser($fName, $lName, $uName, $pWord, $podt)
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
					$sql = "INSERT INTO UserInfo (FNAME, LNAME, PASSWORD, USERNAME, PODT) VALUES ('" . $fName . "', '"  . $lName  . "', '"  . $pWord  . "', '"  . $uName  . "', '" . $podt . "')";
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

			 if($this->isProjectMember($username, $proj)){
			 	$_SESSION['Error'] = "Invitee is a part of project";
			 	return false;
			 }
			 else{
			 	$this->addUserToProject($username,$proj, -1);
				return true;
			 }

		}

		public function addItemToBacklog($us){
			 //$item = array("asa", "iwant", "inorderto", "accept", "size", "sprint");
			 $dbcon = $this->setUpDB();
			 $backlog = $_SESSION['project']."PBL";
			 $newid = $this->getfirstidinpbl();
			 $newus = 9999998; //this field is to specify that we are adding a new userstory
			 $this -> updateOrder($newid,$newus);
			 $us->setid($newid);
			 $sql = "INSERT INTO ".$backlog." (ID, ASA, IWANT, INORDERTO, ACCEPT, SIZE, SPRINT, DONEPERCENT, APPROVED, REASON) VALUES (".$us->getid().", '".$us->getasa()."', '".$us->getiwant()."', '".$us->getinorderto()."', '".$us->getaccept()."', '".$us->getsize()."', ".$us->getsprint().", ".$us->getdonepercent().", '".$us->getapproved()."', '".$us->getreason()."')";
			 $dbcon->exec($sql);

		}
		public function getAllProductBacklogItems(){
			$dbcon = $this->setUpDB();
			$pbl = $_SESSION['project'] . "PBL";
			$sql = "SELECT * FROM ". $pbl;
			$list = new ArrayObject();
			foreach($dbcon->query($sql) as $row){
				$us = new UserStoryInfo($row['ID'],$row['ASA'],$row['IWANT'],$row['INORDERTO'],$row['ACCEPT'],$row['SIZE'],$row['SPRINT'],$row['DONEPERCENT'],$row['APPROVED'],$row['REASON']);
				$list->append($us);
			}
			return $list;
		}
		public function getAllSprintBacklogItems($sprintNumber){
			$dbcon = $this->setUpDB();
			$pbl = $_SESSION['project'] . "PBL";
			$sql = "SELECT * FROM ". $pbl." WHERE SPRINT = '".$sprintNumber."'";
			$list = new ArrayObject();
			foreach($dbcon->query($sql) as $row){
				$us = new UserStoryInfo($row['ID'],$row['ASA'],$row['IWANT'],$row['INORDERTO'],$row['ACCEPT'],$row['SIZE'],$row['SPRINT'],$row['DONEPERCENT'],$row['APPROVED'],$row['REASON']);
				$list->append($us);
			}
			return $list;
		}

		public function editUserStory($id, $asa, $iwant, $inorder, $acpt, $size) {
				$succeed = true;
				$dbcon = $this->setUpDB();
				$pbl = $_SESSION['project'] . "PBL";
				$sql = "UPDATE " . $pbl . " SET ASA='" . $asa . "', IWANT='" . $iwant . "', INORDERTO='" . $inorder . "', ACCEPT='" . $acpt . "', SIZE='" . $size . "' WHERE ID=" . $id;
				$dbcon->exec($sql) or die($succeed = false);
				return $succeed;
				// $sql = "UPDATE " . $pbl . " SET ASA='" . $asa . "', IWANT='" . $iwant . "', INORDERTO='" . $sothat . "', ACCEPT='" . $acpt . "', SIZE=" . $size . " WHERE ID=" . $id;
				// $dbcon->exec($sql);
				// foreach($dbcon->query("SELECT * FROM ".$_SESSION['project']."PBL where id = ".$id)as $row){
				// 	if($row['ASA']==$asa && $row['IWANT']==$iwant && $row['INORDERTO']==$sothat && $row['ACCEPT']==$acpt && $row['SIZE']==$size){
				// 		return true;
				// 	}
				// 	else{
				// 		return false;
				// 	}
				// }
		}

		public function moveToSprint($sprintnum, $usid){
			$dbcon = $this->setUpDB();
			$pbl = $_SESSION['project']."PBL";
			$sql = "UPDATE ".$pbl." SET SPRINT = ".$sprintnum." WHERE ID = ".$usid;
			$dbcon->exec($sql);
			$sqlcheck = "SELECT * FROM ".$pbl." WHERE ID =".$usid;
			foreach($dbcon->query($sqlcheck) as $row){
				if($row['SPRINT']==$sprintnum){
					return true;
				}
				else return false;
			}

		}

		public function viewPending($user) {
			$dbcon = $this->setUpDB();
			$sql = "SELECT * from UserProjectInfo WHERE username = '".$user."' AND ACCEPT=-1";
			try{
				return $dbcon->query($sql);
			}
			catch(PDOException $e) {
				echo "Connection Failed: " . $e->getMessage();
			}
			return "NONE";
		}

		public function reject($projName, $uname) {
			$dbcon = $this->setUpDB();
			$sql = "DELETE from UserProjectInfo WHERE username = '".$uname."' AND projectName='". $projName ."' AND ACCEPT=-1";
			$dbcon->exec($sql);
			$sql = "SELECT * FROM UserProjectInfo WHERE USERNAME='".$uname."' AND projectName='". $projName."'";
			$isNotEmpty = $dbcon->query($sql);
			if($isNotEmpty) {
				return false;
			}
			return true;
		}

		public function accept($projName, $uname) {
			$dbcon = $this->setUpDB();
			$sql = "UPDATE UserProjectInfo SET ACCEPT=1 WHERE username = '".$uname."' AND projectName='". $projName."'";
			$dbcon->exec($sql);
			$sql = "SELECT * FROM UserProjectInfo WHERE USERNAME='".$uname."' AND projectName='". $projName."'";
			foreach($dbcon->query($sql) as $row){
				if($row['ACCEPT']==1){
					return true;
				}
			}
			return false;
		}
	}
?>
