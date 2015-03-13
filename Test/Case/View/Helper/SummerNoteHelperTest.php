<?php
App::uses('View', 'View');
App::uses('Helper', 'View');
App::uses('SummerNoteHelper', 'TwitterBootstrapAdmin.View/Helper');

/**
 * SummerNoteHelper Test Case
 *
 */
class SummerNoteHelperTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$View = new View();
		$this->SummerNote = new SummerNoteHelper($View);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SummerNote);

		parent::tearDown();
	}

/**
 * testInput method
 *
 * @return void
 */
	public function testInputNull(){
		$result = $this->SummerNote->input();
		$this->assertFalse($result);
	}
	public function testInput() {
		// $this->markTestIncomplete('testInput not implemented.');
		$result = $this->SummerNote->input('Foo.content');
		$pattern = '/<div(.*)?><label(.+)?>(.*)?<\/label>(.*)?<\/div>/';
		$this->assertRegExp($pattern, $result);
	}

}
