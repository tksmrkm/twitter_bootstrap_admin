<div class="<?php echo $pluralVar; ?> index">
    <h2><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
<?php foreach ($fields as $field): ?>
                    <th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
<?php endforeach; ?>
                    <th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
                </tr>
            </thead>
            <tbody>
            <?php
            echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
            echo "\t\t\t\t<tr>\n";
                foreach ($fields as $field) {
                    $isKey = false;
                    if (!empty($associations['belongsTo'])) {
                        foreach ($associations['belongsTo'] as $alias => $details) {
                            if ($field === $details['foreignKey']) {
                                $isKey = true;
                                echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t\t\t</td>\n";
                                break;
                            }
                        }
                    }
                    if ($isKey !== true) {
                        echo "\t\t\t\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
                    }
                }

                echo "\t\t\t\t\t<td class=\"actions\">\n";
                echo "\t\t\t\t\t\t<?php echo \$this->Html->link(__('View'), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
                echo "\t\t\t\t\t\t<?php echo \$this->Html->link(__('Edit'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
                echo "\t\t\t\t\t\t<?php echo \$this->Form->postLink(__('Delete'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array(), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
                echo "\t\t\t\t\t</td>\n";
            echo "\t\t\t\t</tr>\n";

            echo "\t\t\t<?php endforeach; ?>\n";
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php echo "<?php echo \$this->element('TwitterBootstrapAdmin.pagination'); ?>"; ?>


<?php echo "<?php \$this->start('sidebar_actions'); ?>\n"; ?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo "<?php echo __('Actions'); ?>"; ?></div>
    <ul class="list-group">
        <li class="list-group-item"><?php echo "<?php echo \$this->Html->link(__('New " . $singularHumanName . "'), array('action' => 'add')); ?>"; ?></li>
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
<?php echo "<?php \$this->end(); ?>\n"; ?>
