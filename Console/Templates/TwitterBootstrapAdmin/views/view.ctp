<div class="<?php echo $pluralVar; ?> view">
    <h2><?php echo "<?php echo __('{$singularHumanName}'); ?>"; ?></h2>
    <dl class="dl-horizontal">
<?php
foreach ($fields as $field) {
    $isKey = false;
    if (!empty($associations['belongsTo'])) {
        foreach ($associations['belongsTo'] as $alias => $details) {
            if ($field === $details['foreignKey']) {
                $isKey = true;
                echo "\t\t<dt><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></dt>\n";
                echo "\t\t<dd>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t&nbsp;\n\t\t</dd>\n";
                break;
            }
        }
    }
    if ($isKey !== true) {
        echo "\t\t<dt><?php echo __('" . Inflector::humanize($field) . "'); ?></dt>\n";
        echo "\t\t<dd>\n\t\t\t<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t\t&nbsp;\n\t\t</dd>\n";
    }
}
?>
    </dl>
</div>

<?php echo "<?php \$this->start('sidebar_actions'); ?>\n"; ?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo "<?php echo __('Actions'); ?>"; ?></div>
    <ul class="list-group">
<?php
    echo "\t\t<li class=\"list-group-item\"><?php echo \$this->Html->link(__('Edit " . $singularHumanName ."'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?> </li>\n";
    echo "\t\t<li class=\"list-group-item\"><?php echo \$this->Form->postLink(__('Delete " . $singularHumanName . "'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array(), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?> </li>\n";
    echo "\t\t<li class=\"list-group-item\"><?php echo \$this->Html->link(__('List " . $pluralHumanName . "'), array('action' => 'index')); ?> </li>\n";
    echo "\t\t<li class=\"list-group-item\"><?php echo \$this->Html->link(__('New " . $singularHumanName . "'), array('action' => 'add')); ?> </li>\n";

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
<?php echo "<?php \$this->end(); ?>\n"; ?>

<?php
if (!empty($associations['hasOne'])) :
    foreach ($associations['hasOne'] as $alias => $details): ?>
    <div class="related">
        <h3><?php echo "<?php echo __('Related " . Inflector::humanize($details['controller']) . "'); ?>"; ?></h3>
    <?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
        <dl class="dl-horizontal">
    <?php
            foreach ($details['fields'] as $field) {
                echo "\t\t<dt><?php echo __('" . Inflector::humanize($field) . "'); ?></dt>\n";
                echo "\t\t<dd>\n\t<?php echo \${$singularVar}['{$alias}']['{$field}']; ?>\n&nbsp;</dd>\n";
            }
    ?>
        </dl>
    <?php echo "<?php endif; ?>\n"; ?>
    </div>
    <?php
    endforeach;
endif;
if (empty($associations['hasMany'])) {
    $associations['hasMany'] = array();
}
if (empty($associations['hasAndBelongsToMany'])) {
    $associations['hasAndBelongsToMany'] = array();
}
$relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
foreach ($relations as $alias => $details):
    $otherSingularVar = Inflector::variable($alias);
    $otherPluralHumanName = Inflector::humanize($details['controller']);
    ?>
<div class="related">
    <h3><?php echo "<?php echo __('Related " . $otherPluralHumanName . "'); ?>"; ?></h3>
    <?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
<?php foreach ($details['fields'] as $field): ?>
                <th><?php echo "<?php echo __('" . Inflector::humanize($field) . "'); ?>";?></th>
<?php endforeach; ?>
                <th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
            </tr>
        </thead>
        <tbody>
<?php
echo "\t\t<?php foreach (\${$singularVar}['{$alias}'] as \$key => \${$otherSingularVar}): ?>\n";
        echo "\t\t\t<tr>\n";
            foreach ($details['fields'] as $field) {
                echo "\t\t\t\t<td><?php echo \${$otherSingularVar}['{$field}']; ?></td>\n";
            }

            echo "\t\t\t\t<td class=\"actions\">\n";
        ?>
                    <div class="dropdown clearfix">
                        <button class="btn btn-default dropdown-toggle" type="button" id="<?php echo $singularVar, '<?php echo $key; ?>'; ?>" data-toggle="dropdown" aria-expanded="true"><?php echo __('Actions'); ?><span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="<?php echo $singularVar, '<?php echo $key; ?>'; ?>">
                            <li role="presentation"><?php echo "<?php echo \$this->Html->link(__('View'), array('controller' => '{$details['controller']}', 'action' => 'view', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>"; ?></li>
                            <li role="presentation"><?php echo "<?php echo \$this->Html->link(__('Edit'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>"; ?></li>
                            <li role="presentation"><?php echo "<?php echo \$this->Form->postLink(__('Delete'), array('controller' => '{$details['controller']}', 'action' => 'delete', \${$otherSingularVar}['{$details['primaryKey']}']), array(), __('Are you sure you want to delete # %s?', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>"; ?></li>
                        </ul>
                    </div>
        <?php
            echo "\t\t\t\t</td>\n";
        echo "\t\t\t</tr>\n";

echo "\t\t<?php endforeach; ?>\n";
?>
        </tbody>
    </table>
<?php echo "<?php endif; ?>\n\n"; ?>
</div>
<?php endforeach; ?>
