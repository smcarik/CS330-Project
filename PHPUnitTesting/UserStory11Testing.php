<?php

include __DIR__.'/../Controllers/DBController.php';
session_start();

class testPhpUnit extends PHPUnit_Framework_TestCase {
	public function testUsersHaveRoles(){
		$db = new ContactDB;
		$db->login("smcarik","123");
		echo $_SESSION['Role'];
		$this->assertTrue($_SESSION['Role'] == 1);
	}
}

?>