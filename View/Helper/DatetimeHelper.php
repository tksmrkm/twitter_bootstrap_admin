<?php

class DatetimeHelper extends AppHelper {
    public $helpers = array(
        'Form',
        'Html',
    );
    public function beforeRender($viewFile){
        echo $this->Html->css('TwitterBootstrapAdmin./lib/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min', array('inline' => false));
        echo $this->Html->script('TwitterBootstrapAdmin./lib/moment/moment.min', array('inline' => false));
        echo $this->Html->script('TwitterBootstrapAdmin./lib/eonasdan-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min', array('inline' => false));
    }

    public function _code($id, $options = array()){
        $cameled_id = preg_replace('/ /', '', ucwords(preg_replace('/[\._]/', ' ', $id)));
        $default = array(
            'stepping' => 5,
            'useCurrent' => false,
            'collapse' => false,
            'sideBySide' => true,
            'showTodayButton' => true,
            'showClear' => true
        );
        $options = array_merge($default, $options);
        $options = json_encode($options);
$code = <<<SCRIPT
\$(function(){
    \$({$cameled_id}).datetimepicker({$options});
});
SCRIPT;
        return $this->Html->scriptBlock($code, array('safe' => false));
    }
    public function input($id, $options = array()){
        $script = $this->_code($id, $options);
        $form   = $this->Form->input($id, array('type' => 'text'));
        return $form . $script;
    }
}