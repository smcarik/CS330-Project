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
		$us = new UserStoryInfo(0,"User","move PBl items","redorder shit","heeeheee","M", 0, 0, NULL, NULL);
		$_SESSION['project'] = "savage";
		$db->addItemToBacklog($us);
		$this->assertTrue($db->editUserStory(0,"User", "edited", "redorder shit","heeeheee","M"));
	}
}
?>