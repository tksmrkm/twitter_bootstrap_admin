<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <?php
        echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'));
        echo $this->fetch('meta');
        echo $this->Html->css('TwitterBootstrapAdmin./lib/bootstrap/css/bootstrap.min');
        echo $this->Html->css('TwitterBootstrapAdmin./lib/jquery-ui/css/base/theme');
        echo $this->Html->css('TwitterBootstrapAdmin./lib/font-awesome/css/font-awesome.min');
        echo $this->Html->css('TwitterBootstrapAdmin.base');
        if(file_exists(ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS . 'css' . DS . 'twbs_dashboard.base.css')){
            echo $this->Html->css('twbs_dashboard.base');
        }
        echo $this->fetch('css');
        echo $this->Html->script('TwitterBootstrapAdmin./lib/jquery/js/jquery.min');
        echo $this->Html->script('TwitterBootstrapAdmin./lib/jquery-ui/js/jquery-ui.min');
        echo $this->Html->script('TwitterBootstrapAdmin./lib/bootstrap/js/bootstrap.min');
        if($this->Html->script('twbs_dashboard.main')){
            echo $this->Html->script('twbs_dashboard.main');
        }
        echo $this->fetch('script');
    ?>
    <title><?php echo $title_for_layout ? $title_for_layout . ' | ' : null; ?><?php echo __('Dashboard'); ?></title>
</head>
<body>
    <?php
        if($this->elementExists('dashboard/global_nav')){
            echo $this->element('dashboard/global_nav');
        }
    ?>
    <header class="header container-fluid"><h1><?php echo __('Dashboard'); ?></h1></header>
    <section class="container-fluid">
        <div class="row">
            <section class="col-md-9">
                <?php echo $this->Session->flash('flash', array('element' => 'TwitterBootstrapAdmin.flash')); ?>
                <main id="main">
                    <?php echo $this->fetch('content'); ?>
                </main>
            </section>
            <aside class="col-md-3">
                <?php echo $this->fetch('related_actions'); ?>
                <?php
                    if($this->elementExists('dashboard/sidebar')){
                        echo $this->element('dashboard/sidebar');
                    }
                ?>
            </aside>
        </div>
    </section>
</body>
</html>