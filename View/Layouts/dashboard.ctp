<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <?php
        echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'));
        echo $this->fetch('meta');
        echo $this->Html->css('TwitterBootstrapAdmin./bootstrap/css/bootstrap.min');
        echo $this->Html->css('TwitterBootstrapAdmin./jquery-ui/themes/jquery-ui.min');
        echo $this->Html->css('TwitterBootstrapAdmin./jquery-ui/themes/theme');
        echo $this->fetch('css');
        echo $this->Html->script('TwitterBootstrapAdmin.jquery/jquery.min');
        echo $this->Html->script('TwitterBootstrapAdmin./jquery-ui/jquery-ui.min');
        echo $this->Html->script('TwitterBootstrapAdmin./bootstrap/js/bootstrap.min');
        echo $this->fetch('script');
    ?>
    <title><?php echo $title_for_layout ? $title_for_layout . ' | ' : null; ?><?php echo __('Dashboard'); ?></title>
</head>
<body>
    <header><h1><?php __('Dashboard'); ?></h1></header>
    <section class="container-fluid">
        <div class="row">
            <main class="col-md-9">
                <?php echo $this->fetch('content'); ?>
            </main>
            <aside class="col-md-3">
                <?php echo $this->fetch('sidebar_actions'); ?>
                <div class="panel panel-default">
                    <div class="panel-heading">Heading</div>
                    <ul class="list-group">
                        <li class="list-group-item">Items</li>
                    </ul>
                </div>
            </aside>
        </div>
    </section>
</body>
</html>