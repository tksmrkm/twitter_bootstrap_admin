<?php
App::uses('View', 'View');
App::uses('Helper', 'View');
App::uses('DatetimeHelper', 'TwitterBootstrapAdmin.View/Helper');

/**
 * DatetimeHelper Test Case
 *
 */
class DatetimeHelperTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$View = new View();
		$this->Datetime = new DatetimeHelper($View);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Datetime);

		parent::tearDown();
	}

/**
 * testInput method
 *
 * @return void
 */
    public function testInputNull(){
        $result = $this->Datetime->input();
        $this->assertFalse($result);
    }
	public function testInput() {
        $input_id = 'Foo.id';
        $default_option = array(
            'stepping' => 5,
            'useCurrent' => false,
            'collapse' => false,
            'sideBySide' => true,
            'showTodayButton' => true,
            'showClear' => true
        );
        $add_option = array(
            'foo' => 'bar',
            'stepping' => 5
        );
        $options = array_merge($this->Datetime->defaults, $add_option);
        $cameled_id = preg_replace('/ /', '', ucwords(preg_replace('/[\._]/', ' ', $input_id)));
        $json = json_encode($options);

        $excepted = '<div class="input text"><label for="FooId">Id</label><input name="data[Foo][id]" type="text" id="FooId"/></div><script type="text/javascript">$(function(){
    $(\'#' . $cameled_id . '\').datetimepicker(' . $json . ');
});</script>';

        $result = $this->Datetime->input($input_id, $add_option);
        $this->assertEquals($result, $excepted);
	}

}
