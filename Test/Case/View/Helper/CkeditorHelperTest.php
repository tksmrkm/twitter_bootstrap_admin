<?php
App::uses('View', 'View');
App::uses('Helper', 'View');
App::uses('CkeditorHelper', 'TwitterBootstrapAdmin.View/Helper');

/**
 * CkeditorHelper Test Case
 *
 */
class CkeditorHelperTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$View = new View();
		$this->Ckeditor = new CkeditorHelper($View);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ckeditor);

		parent::tearDown();
	}

/**
 * testLoad method
 *
 * @return void
 */
	public function testLoadNull() {
		$result = $this->Ckeditor->load();
		$this->assertFalse($result);
	}
	public function testLoad() {
		$result = $this->Ckeditor->load('User.content');
		$expected = '/<script type="text\/javascript">CKEDITOR.config.customConfig = \'\/js\/ckeditor.config.js\';var EditorObj[a-zA-Z]+ = CKEDITOR.replace\(\'[a-zA-Z]+\'\);<\/script>/';
		$this->assertRegExp($expected, $result);
	}

/**
 * testInput method
 *
 * @return void
 */
	public function testInputNull() {
		$result = $this->Ckeditor->input();
		$this->assertFalse($result);
	}
	public function testInput() {
		$result = $this->Ckeditor->input('Hoge.fugas');
		$expected = '/<div(.*)?>(.*)?<\/div><script(.*)?>(.*)?<\/script>/';
		$this->assertRegExp($expected, $result);
	}

}
