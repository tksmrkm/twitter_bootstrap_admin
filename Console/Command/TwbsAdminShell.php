<?php

class TwbsAdminShell extends AppShell {
    public function setup(){
        parent::setup();
    }
    public function main(){
        $this->out('connect');
    }
}