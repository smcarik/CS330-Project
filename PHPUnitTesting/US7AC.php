<?php
include __DIR__.'/../Controllers/DBController.php';
include __DIR__.'/../ProjectHomePage/projectHomePage.php';
// Will edit this accordingly when the US4 gets some body to it. 

//include __DIR__.'/../Controllers/DBController.php';

class testPhpUnit extends PHPUnit_Framework_TestCase 
{
	public function testGetAllProjsForUser()
	{
		$db = new ContactDB;
		$db->setUpDB();
		$db->addIfUnique("testProj", "description");
		session_start();
		$_SESSION['project'] = "testProj";
		$this->assertTrue($db->getNumOfColsForProj()>=5);
	}
}
?>