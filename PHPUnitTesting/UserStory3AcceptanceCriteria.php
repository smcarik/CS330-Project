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
	public function testUniqueName() { 
		$db = new ContactDB;
		$db->setUpDB();
		$b = $db->addIfUnique("Test 1", "1");
		$this->assertFalse($b);
		$this->assertTrue($db->addIfUnique("Test 111", "hehehe"));
	}
}

?>