<?php

class BootComponent extends Component {
    public $settings = array(
        'useAdmin' => array(
            'index',
            'edit',
            'add',
            'view'
        ),
        'layouts' => array(
            'public' => 'default',
            'admin' => 'TwitterBootstrapAdmin.dashboard'
        ),
        'checkLayout' => true
    );
    public function __construct(ComponentCollection $collection, $settings = array()) {
        $settings = array_merge($this->settings, (array)$settings);
        $this->Controller = $collection->getController();
        parent::__construct($collection, $settings);

        if($this->settings['checkLayout']){
            $this->_checkLayout();
        }
    }
    private function _checkLayout(){
        $this->settings['useAdmin'] = Hash::merge($this->settings['useAdmin'], $this->Controller->useAdmin);

        if(in_array($this->Controller->action, $this->settings['useAdmin'])){
            $this->Controller->layout = $this->settings['layouts']['admin'];
        }else{
            $this->Controller->layout = $this->settings['layouts']['public'];
        }
    }
}