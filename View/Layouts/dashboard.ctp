<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <?php
        echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'));
        echo $this->fetch('meta');
        echo $this->Html->css('TwitterBootstrapAdmin./bootstrap/css/bootstrap.min');
        echo $this->Html->css('TwitterBootstrapAdmin./jquery-ui/themes/base/theme');
        echo $this->fetch('css');
        echo $this->Html->script('TwitterBootstrapAdmin.jquery/jquery.min');
        echo $this->Html->script('TwitterBootstrapAdmin./jquery-ui/jquery-ui.min');
        echo $this->Html->script('TwitterBootstrapAdmin./bootstrap/js/bootstrap.min');
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
            <main class="col-md-9">
                <?php echo $this->fetch('content'); ?>
            </main>
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