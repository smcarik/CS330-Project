<?php
	class ContactDB{
		public $dbcon;
		
		function setUpDB(){
			$dbcon = new PDO(
					'mysql:host=devsrv.cs.csbsju.edu;dbname=BlazinPretzels',
					'BlazinPretzels',
					'csci330'
					);
			$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		}
		
		function addIfUnique($newProjectName, $newProjectDescription){
			$sql = "SELECT * FROM ProjectInfo";
			 
			foreach($db->query($sql) as $row) {
				if(strcmp($row["Name"],$newProjectName) == 0) { //checks each project name in table to see if it matches input
					$projectNameUsed = true;
				}
			}
			if(!$projectNameUsed){
				$sql = "INSERT INTO ProjectInfo (Name, ProjectDesc) VALUES (".$newProjectName.", ".$newProjectDescription.")";
				$db->exec($sql);
				return true;
			}
			return false;
		}
	}
?>