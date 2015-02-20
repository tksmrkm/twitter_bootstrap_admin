<?php

class TwbsAdminShell extends AppShell {
    public function startup(){
        parent::startup();
        $this->plugin_root = ROOT . DS . APP_DIR . DS . 'Plugin' . DS . 'TwitterBootstrapAdmin';
    }

    public function getOptionParser() {
        $parser = parent::getOptionParser();
        return $parser->addSubcommand('copy', array(
            'help' => __('Copy template files. ex) View/Elements/dashboard/global_menu.ctp.sample')
        ));
    }

    public function main(){
        $this->out($this->getOptionParser()->help());
    }

    public function copy(){
        $copy_files = array(
            'View' . DS . 'Elements' . DS . 'dashboard' . DS . 'sidebar.ctp.sample',
            'View' . DS . 'Elements' . DS . 'dashboard' . DS . 'global_nav.ctp.sample',
        );
        foreach($copy_files as $file){
            $source = $this->plugin_root . DS . $file;
            $dest   = ROOT . DS . APP_DIR . DS . $file;
            $dest_dir = dirname($dest);

            // create directory if it's not exists.
            if(!is_dir($dest_dir)){
                mkdir($dest_dir, 0755, true);
            }

            // copy
            if(file_exists($dest)){
                $this->out('Already exsists: ' . $file);
                continue;
            }elseif(file_exists($source)){
                if(copy($source, $dest)){
                    $this->out('Success: ' . $file);
                }else{
                    $this->out('Error: ' . $file);
                }
            }
        }
    }
}