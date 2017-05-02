<?php
include __DIR__.'/../Controllers/DBController.php';
session_start();
//include __DIR__.'/../ProjectHomePage/projectHomePage.php';
// Will edit this accordingly when the US4 gets some body to it. 

//include __DIR__.'/../Controllers/DBController.php';

class testPhpUnit extends PHPUnit_Framework_TestCase {
	public function testEditPBLitem()
	{
		$db = new ContactDB;
		$db->setUpDB();
		$db->inviteToProject("adam", "savage");
		$b1 = $db->reject("savage", "adam");
		$db->inviteToProject("adam", "savage");
		$b2 = $db->accept("savage", "adam");
		$this->assertTrue($b1&&$b2);
	}
}
?>