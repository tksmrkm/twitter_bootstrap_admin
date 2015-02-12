<?php

class SummerNoteHelper extends AppHelper {
    public $helpers = array(
        'Html',
        'Form'
    );
    public function beforeRender($viewFile){
        echo $this->Html->css('TwitterBootstrapAdmin./lib/summernote/summernote', array('inline' => false));
        echo $this->Html->css('TwitterBootstrapAdmin./lib/summernote/summernote-bs3', array('inline' => false));
        echo $this->Html->script('TwitterBootstrapAdmin./lib/summernote/summernote.min', array('inline' => false));
    }
    public function input($id = null, $url = array()){
        $cameled_id = preg_replace('/ /', '', ucwords(preg_replace('/[\._]/', ' ', $id)));
        $input = $this->Form->input($id);
        $url_array = empty($url) ? array('controller' => 'summernote', 'action' => 'upload', 'plugin' => 'twitter_bootstrap_admin') : $url;
        $upload_url = $this->Html->url($url_array);
$code = <<<SCRIPT
\$(function(){
    \$('#{$cameled_id}').summernote({
        onImageUpload: function(files, editor, welEditable){
            send_file(files[0], editor, welEditable);
        }
    });

    function send_file(file, editor, welEditable){
        data = new FormData();
        data.append("file", file);
        $.ajax({
            url: '{$upload_url}',
            type: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(url) {
            editor.insertImage(welEditable, url);
        })
        .fail(function() {
        })
        .always(function() {
        });
    }
});
SCRIPT;
        $script = $this->Html->scriptBlock($code, array('inline' => false, 'safe' => false));
        return $input . $script;
    }
}