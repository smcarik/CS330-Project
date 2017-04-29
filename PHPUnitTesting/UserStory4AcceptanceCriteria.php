<?php
include __DIR__.'/../Controllers/DBController.php';
// Will edit this accordingly when the US4 gets some body to it. 

//include __DIR__.'/../Controllers/DBController.php';

class testPhpUnit extends PHPUnit_Framework_TestCase 
{
	public function testMemberEntersValidUNameAndGetsProj()
	{
		$db = new ContactDB;
		$db->setUpDB();
		$this->assertTrue($db->addUserToProject("adam", "savage"));
	}
	
	public function testFailInviteCurrentMembers()
	{
		$db = new ContactDB;
		$db->setUpDB();
		$this->assertFalse($db->addUserToProject("adam", "savage"));
	}
	
	public function testMustBeMemberToInvite()
	{
		$db = new ContactDB;
		$db->setUpDB();
		$this->assertFalse($db->addUserToProject("paul bunyan", "savage"));
	}
}
?>