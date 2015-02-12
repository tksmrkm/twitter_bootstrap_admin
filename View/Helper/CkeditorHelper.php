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
        $cameled_id = preg_replace('/ /', '', ucwords(preg_replace('/[\._]/', ' ', $id)));
        $config_path = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS . 'js' . DS . 'ckeditor.config.js';
        $config_url  = $this->Html->url('/js/ckeditor.config.js');
        $code = '';
        $code .= file_exists($config_path) ? "CKEDITOR.config.customConfig = '{$config_url}';" : null;
        $code .= "var EditorObj" . $cameled_id . " = CKEDITOR.replace('" . $cameled_id . "');";
        return $this->Html->scriptBlock($code, array('safe' => false));
    }
    public function input($id){
        $script = $this->load($id);
        $input = $this->Form->input($id);
        return $input . $script;
    }
}