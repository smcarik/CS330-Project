<?php

include __DIR__.'/../Controllers/DBController.php';
session_start();

class testPhpUnit extends PHPUnit_Framework_TestCase {
	public function testUsersHaveRolesDev(){
		$db = new ContactDB;
		$db->login("smcarik","123");
		echo $_SESSION['Role'];
		$this->assertTrue($_SESSION['Role'] == 1);
	}
	
	public function testUsersHaveRolesPO(){
		$db = new ContactDB;
		$db->login("adam","adam");
		$this->assertTrue($_SESSION['Role'] == 0);
	}
}

?>