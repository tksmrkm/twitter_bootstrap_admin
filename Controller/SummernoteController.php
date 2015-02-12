<?php

class SummernoteController extends TwitterBootstrapAdminAppController {
/**
 * AjaxUploader
 */
    public function upload(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            if(preg_match('/^image/', $_FILES['file']['type'])){
                $tmp_name  = $_FILES['file']['tmp_name'];
                $file_name = $_FILES['file']['name'];
                $title     = explode('.', $file_name);
                $extension = array_pop($title);
                $title     = implode('.', $title);
                if(!file_exists($this->updir)){
                    mkdir($this->updir);
                }
                $destinate = $this->updir . DS . $file_name;
                $i = 0;
                while(true){
                    $i++;
                    if(!file_exists($destinate)){
                        break;
                    }else{
                        $file_name = $title . '_' . $i . '.' . $extension;
                        $destinate = $this->updir . DS . $file_name;
                    }
                }
                $result = move_uploaded_file($tmp_name, $destinate);
                return $this->upurl . '/' . $file_name;
            }else{
                return json_encode(array(
                    'status' => false,
                    'message' => 'Unsupported media type'
                ));
            }
        }else{
            throw new ForbiddenException();
        }
    }
/**
 * Browsing
 */
    public function index(){
        $this->autoRender = false;
        $files = array();
        foreach(scandir($this->updir) as $file){
            if(preg_match('/^\.+$/', $file)){
                continue;
            }
            $files[] = $file;
        }
        $this->set('files', $files);
    }
    public function beforeFilter(){
        parent::beforeFilter();
        $this->updir = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS . 'img' . DS . 'upload';
        $this->upurl = Router::url('/img/upload');
    }
}