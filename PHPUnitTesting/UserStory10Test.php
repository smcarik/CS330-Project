<?php
include __DIR__.'/../Controllers/DBController.php';
session_start();

class testPhpUnit extends PHPUnit_Framework_TestCase {
	public function testMoveToSprint(){
		$db = new ContactDB;
		$_SESSION['project'] = "savage";
		$success = $db->moveToSprint(1,$db->getfirstidinpbl());
		$this->assertTrue($success);
	}
}
?>