<?php

App::uses('AppHelper', 'View/Helper');

class CkeditorHelper extends AppHelper {
    public $helpers = array(
        'Html',
        'Form'
    );
    public function beforeRender($viewFile){
        echo $this->Html->scriptBlock('const WEBROOT = "' . $this->Html->url('/') . '";', array('safe' => false, 'inline' => false));
        echo $this->Html->script('TwitterBootstrapAdmin./lib/ckeditor/ckeditor', array('inline' => false));
    }
    public function load($id){
        $did = '';
        foreach(explode('.', $id) as $v){
            $did .= ucfirst($v);
        }
        $code = "var EditorObj" . $did . " = CKEDITOR.replace('" . $did . "');";
        return $this->Html->scriptBlock($code, array('safe' => false));
    }
    public function input($id){
        $script = $this->load($id);
        $input = $this->Form->input($id);
        return $input . $script;
    }
}