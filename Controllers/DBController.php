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
	}
?>