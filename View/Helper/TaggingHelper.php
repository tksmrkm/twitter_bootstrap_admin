<?php

/**
 * @todo 登録済みタグをリストに表示
 * @link https://github.com/brianreavis/selectize.js/blob/master/docs/usage.md
 */

App::uses('AppHelper', 'View/Helper');

class TaggingHelper extends AppHelper {
    public $helpers = array(
        'Html',
        'Form'
    );
    public function input($id = null, $options = array()){
        if(is_null($id)){
            return false;
        }else{
            echo $this->Html->css('TwitterBootstrapAdmin./lib/selectize/css/selectize.bootstrap3', array('inline' => false));
            echo $this->Html->css('TwitterBootstrapAdmin./lib/selectize/css/selectize.default', array('inline' => false));
            echo $this->Html->script('TwitterBootstrapAdmin./lib/selectize/js/selectize.min', array('inline' => false));
            $did = '';
            foreach(explode('.', $id) as $v){
                $did .= ucfirst($v);
            }
            $options_json = json_encode($options);
$code = <<<SCRIPT
$(function(){
    $('#{$did}').selectize({
        delimiter: ', ',
        persist: false,
        create: function(input){
            return {
                value: input,
                text: input
            };
        },
        options: {$options_json},
    });
});
SCRIPT;
            echo $this->Html->scriptBlock($code, array('safe' => false, 'inline' => false));
            return $this->Form->input($id);
        }
    }
}