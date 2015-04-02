<?php
App::uses('ComponentCollection', 'Controller');
App::uses('Component', 'Controller');
App::uses('BootComponent', 'TwitterBootstrapAdmin.Controller/Component');

/**
 * BootComponent Test Case
 *
 */
class BootComponentTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$Collection = new ComponentCollection();
		$this->Boot = new BootComponent($Collection);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Boot);

		parent::tearDown();
	}

}
