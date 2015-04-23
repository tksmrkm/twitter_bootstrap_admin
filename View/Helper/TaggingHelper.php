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
    public function beforeRender($viewFile){
        echo $this->Html->css('TwitterBootstrapAdmin./lib/selectize/css/selectize.bootstrap3', array('inline' => false));
        echo $this->Html->css('TwitterBootstrapAdmin./lib/selectize/css/selectize.default', array('inline' => false));
        echo $this->Html->script('TwitterBootstrapAdmin./lib/selectize/js/selectize.min', array('inline' => false));
    }
    public function input($id = null, $options = array(), $settings = array()){
        if(is_null($id)){
            return false;
        }else{
            $cameled_id = preg_replace('/ /', '', ucwords(preg_replace('/[\._]/', ' ', $id)));
            $options_json = json_encode($options);
$code = <<<SCRIPT
$(function(){
    $('#{$cameled_id}').selectize({
        plugins: [
            'restore_on_backspace'
        ],
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
            return $this->Form->input($id, $settings);
        }
    }
}