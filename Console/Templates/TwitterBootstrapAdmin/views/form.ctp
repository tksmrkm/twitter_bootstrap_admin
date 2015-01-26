<div class="<?php echo $pluralVar; ?> form">
    <?php
        $legend = Inflector::humanize($action) . ' ' . $singularHumanName;
        echo "<?php\n\t\techo \$this->Form->create('{$modelClass}', array(\n\t\t\t'inputDefaults' => array(\n\t\t\t\t'dateFormat' => 'YMD',\n\t\t\t\t'monthNames' => false,\n\t\t\t\t'empty' => '---',\n\t\t\t\t'div' => 'form-group',\n\t\t\t\t'class' => 'form-control',\n\t\t\t\t'label' => array(\n\t\t\t\t\t'class' => 'col-sm-2 control-label'\n\t\t\t\t),\n\t\t\t\t'after'  => '</div>',\n\t\t\t\t'between' => '<div class=\"col-sm-10\">'\n\t\t\t),\n\t\t\t'class' => 'form-horizontal',\n\t\t\t'role' => 'form'\n\t\t));\n\t\techo \$this->Form->inputs(array(\n\t\t\t'legend' => __('{$legend}'),\n";

        foreach ($fields as $field) {
            if (strpos($action, 'add') !== false && $field === $primaryKey) {
                continue;
            } elseif($field === 'parent_id') {
                echo "\t\t\t'" . $field . "' => array('options' => \$parent" . $pluralHumanName . ", 'empty' => true),\n";
            } elseif (!in_array($field, array('created', 'modified', 'updated'))) {
                echo "\t\t\t'" . $field . "',\n";
            }
        }
        if (!empty($associations['hasAndBelongsToMany'])) {
            foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
                echo "\t\t\t'" . $assocName . "',\n";
            }
        }
    ?>
    <?php echo "\t));\n\t?>\n"; ?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php echo "<?php\n\t\t\t\techo \$this->Form->button(__('submit'), array(\n\t\t\t\t\t'type' => 'submit',\n\t\t\t\t\t'class' => 'btn btn-primary btn-block'\n\t\t\t\t));\n\t\t\t?>\n" ?>
        </div>
    </div>
    <?php echo "<?php echo \$this->Form->end(); ?>\n"; ?>
</div>

<?php echo "<?php \$this->start('related_actions'); ?>\n"; ?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo "<?php echo __('Actions'); ?>"; ?></div>
    <ul class="list-group">
<?php if (strpos($action, 'add') === false): ?>
        <li class="list-group-item"><?php echo "<?php echo \$this->Form->postLink(__('Delete'), array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), array(), __('Are you sure you want to delete # %s?', \$this->Form->value('{$modelClass}.{$primaryKey}'))); ?>"; ?></li>
<?php endif; ?>
        <li class="list-group-item"><?php echo "<?php echo \$this->Html->link(__('List " . $pluralHumanName . "'), array('action' => 'index')); ?>"; ?></li>
<?php
        $done = array();
        foreach ($associations as $type => $data) {
            foreach ($data as $alias => $details) {
                if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
                    echo "\t\t<li class=\"list-group-item\"><?php echo \$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index')); ?> </li>\n";
                    echo "\t\t<li class=\"list-group-item\"><?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add')); ?> </li>\n";
                    $done[] = $details['controller'];
                }
            }
        }
?>
    </ul>
</div>
<?php echo "<?php \$this->end(); ?>"; ?>
