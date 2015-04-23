<?php
App::uses('View', 'View');
App::uses('Helper', 'View');
App::uses('TaggingHelper', 'TwitterBootstrapAdmin.View/Helper');

/**
 * TaggingHelper Test Case
 *
 */
class TaggingHelperTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$View = new View();
		$this->Tagging = new TaggingHelper($View);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tagging);

		parent::tearDown();
	}

/**
 * testInput method
 *
 * @return void
 */
	public function testInputNull(){
		$result = $this->Tagging->input();
		$this->assertFalse($result);
	}
	public function testInput() {
		$result = $this->Tagging->input('News.created');
		// '<div class="input select"><label for="TestUserId">User</label><select name="data[Test][user_id]" id="TestUserId"></select></div>'
		$expected = '<div class="input text"><label for="NewsCreated">Created</label><input name="data[News][created]" type="text" id="NewsCreated"/></div>';
		$this->assertEquals($expected, $result);
	}

}
