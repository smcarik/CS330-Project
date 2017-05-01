<?php
include __DIR__.'/../Controllers/DBController.php';
session_start();
// Will edit this accordingly when the US4 gets some body to it. 

//include __DIR__.'/../Controllers/DBController.php';

class testPhpUnit extends PHPUnit_Framework_TestCase 
{
	public function testGetAllProjsForUser()
	{
		$db = new ContactDB;
		$db->addIfUnique("testProj", "description");
		$_SESSION['project'] = "savage";
		$this->assertTrue($db->getNumberOfSprints() == 2);
	}
}
?>