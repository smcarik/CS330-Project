<?php
include __DIR__.'/../Controllers/DBController.php';
session_start();
class testPhpUnit extends PHPUnit_Framework_TestCase {
	public function testLoginSuccess(){
		$db = new ContactDB();
		$this->assertEquals($db->login("smcarik","123"),true);
	}
	
	public function testLoginFailsForPassword(){
		$db = new ContactDB();
		$this->assertEquals($db->login("smcarik","12"),false);
		$this->assertEquals($_SESSION['Error'],"Invalid Password entered for smcarik");
		$_SESSION['Error'] = "none";
	}
	
	public function testLoginFailsForUsername(){
		$db = new ContactDB();
		$this->assertEquals($db->login("smcari","123"),false);
		$this->assertEquals($_SESSION['Error'],"Invalid Username entered");
		$_SESSION['Error'] = "none";
	}
}

?>