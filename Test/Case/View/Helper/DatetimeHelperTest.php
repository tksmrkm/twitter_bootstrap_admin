<?php

App::uses('View', 'View');
App::uses('DatetimeHelper', 'TwitterBootstrapAdmin.View/Helper');

class DatetimeHelperTest extends CakeTestCase {
    public $default_option = array(
        'stepping' => 5,
        'useCurrent' => false,
        'collapse' => false,
        'sideBySide' => true,
        'showTodayButton' => true,
        'showClear' => true
    );
    public $Datetime;
    public function setup(){
        parent::setUp();
        $controller = null;
        $this->View = new View($controller);
        $this->Datetime = new DatetimeHelper($this->View);
    }

    public function testInput(){
        $input_id = 'User.id';
        $add_option = array(
            'foo' => 'bar',
            'stepping' => 5
        );
        $options = array_merge($this->default_option, $add_option);
        $cameled_id = preg_replace('/ /', '', ucwords(preg_replace('/[\._]/', ' ', $input_id)));
        $json = json_encode($options);

        $excepted = '<div class="input text"><label for="UserId">Id</label><input name="data[User][id]" maxlength="11" type="text" id="UserId"/></div><script type="text/javascript">$(function(){
    $(\'#' . $cameled_id . '\').datetimepicker(' . $json . ');
});</script>';

        $result = $this->Datetime->input($input_id, $add_option);
        $this->assertEquals($result, $excepted);
    }
}