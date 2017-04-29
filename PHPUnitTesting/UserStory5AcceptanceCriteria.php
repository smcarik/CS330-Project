<?php
include __DIR__.'/../Controllers/DBController.php';
// Will edit this accordingly when the US4 gets some body to it. 

//include __DIR__.'/../Controllers/DBController.php';

class testPhpUnit extends PHPUnit_Framework_TestCase 
{
	public function testGetAllProjsForUser()
	{
		$db = new ContactDB;
		$db->setUpDB();
		$this->assertTrue($db->getAllProjectsForUser("adam")==
				$db->getAllProjectsForUser("adam"));
	}
	public function testNotMemberOfProjs()
	{
		$db = new ContactDB;
		$db->setUpDB();
		$this->assertFalse($db->getAllProjectsForUser("adam")==
				$db->getAllProjectsForUser("steven"));
	}
}
?>