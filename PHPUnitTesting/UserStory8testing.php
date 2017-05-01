<?php

include __DIR__.'/../Controllers/DBController.php';
session_start();

$db;
class testPhpUnit extends PHPUnit_Framework_TestCase {
	
	//This test method is conditional based on the project, i didnt know how to make it general, but on my test it worked
	/* public function testgetfirstidinpbl(){
		$db = new ContactDB();
		$_SESSION['project']="savage";
		$num = $db->getfirstidinpbl();
		$this->assertTrue($num == 4);
	} */
	
	public function testupdateorderaddnewUS(){
		$db = new ContactDB();
		$_SESSION['project']="savage";
		$us = new UserStoryInfo(0,"person","live","not die","i dont die","M", 0, 0, NULL, NULL);
		$succeed = $db->addItemToBacklog($us);
		$this->assertTrue($succeed);
	}
	
	public function testupdateordermovedown(){
		$db = new ContactDB();
		$_SESSION['project']="savage";
		$succeed = $db->updateorder(6,4);
		$this->assertTrue($succeed);
	}
	
	public function testupdateorderfailsmoveup(){
		$db = new ContactDB();
		$_SESSION['project']="savage";
		$succeed = $db->updateorder(4,6);
		$this->assertFalse($succeed);
	}
}
?>