<?php
include __DIR__.'/../Controllers/DBController.php';
/* 
 * start off with class <class name> extends PHPUnit_Framework_TestCase
 * 
 * use public function <test name>
 * note: test name must include the word test, and test must come first
 * 				<test<test description>>()
 */
class testPhpUnit extends PHPUnit_Framework_TestCase {
	
	Public function test() {
		$this->assertTrue(true);
		$this->assertTrue(5==5);
	}
	
	public function test2(){
		$this->assertTrue(true);
	}
	
	public function testDoesItEqual(){
		$this->assertEquals(5,5);
	}
	
	//Notice how only 4 of the 5 tests are run? this one does not run.  comment it out to check for yourself.
	public function doesTestMatter(){
		$this->assertTrue(true);
	}
	
	public function testdoesTestMatter(){
		$this->assertFalse(5==4);
	}
	
	public function testDbconn(){
		try{
		$db = new ContactDB;
		$db->setUpDB();
		$this->assertTrue($db!=null);
		}
		catch(PDOException $e) {
			echo "Connection Failed: " . $e->getMessage();
		}
	}
}

?>