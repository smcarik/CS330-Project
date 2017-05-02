<?php
include __DIR__.'/../Controllers/DBController.php';
session_start();
//include __DIR__.'/../ProjectHomePage/projectHomePage.php';
// Will edit this accordingly when the US4 gets some body to it. 

//include __DIR__.'/../Controllers/DBController.php';

class testPhpUnit extends PHPUnit_Framework_TestCase {
	public function testReject()
	{
		$db = new ContactDB;
		$db->setUpDB();
		$db->inviteToProject("adam", "RitsBits");
		$b1 = $db->reject("RitsBits", "adam");
		$this->assertTrue($b1);
	}
	public function testAccept()
	{
		$db = new ContactDB;
		$db->setUpDB();
		$db->inviteToProject("adam", "erin");
		$b2 = $db->reject("erin", "adam");
		$this->assertTrue($b2);
	}
}
?>