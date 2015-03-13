<?php

App::uses('AppHelper', 'View/Helper');

class DatetimeHelper extends AppHelper {
    public $helpers = array(
        'Form',
        'Html',
    );

    public $defaults = array(
        'stepping' => 5,
        'useCurrent' => false,
        'collapse' => false,
        'sideBySide' => true,
        'showTodayButton' => true,
        'showClear' => true
    );
    public function beforeRender($viewFile){
        echo $this->Html->css('TwitterBootstrapAdmin./lib/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min', array('inline' => false));
        echo $this->Html->script('TwitterBootstrapAdmin./lib/moment/moment.min', array('inline' => false));
        echo $this->Html->script('TwitterBootstrapAdmin./lib/eonasdan-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min', array('inline' => false));
    }

    public function _code($id, $options = array()){
        $cameled_id = preg_replace('/ /', '', ucwords(preg_replace('/[\._]/', ' ', $id)));
        $options = array_merge($this->defaults, $options);
        $options = json_encode($options);
$code = <<<SCRIPT
\$(function(){
    \$('#{$cameled_id}').datetimepicker({$options});
});
SCRIPT;
        return $this->Html->scriptBlock($code, array('safe' => false));
    }
    public function input($id = null, $options = array(), $settings = array()){
        if(is_null($id)) return false;
        $script = $this->_code($id, $options);
        $settings = array_merge(array('type' => 'text'), $settings);
        $form   = $this->Form->input($id, $settings);
        return $form . $script;
    }
}