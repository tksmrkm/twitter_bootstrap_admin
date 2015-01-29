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
            echo "<?php foreach (\${$pluralVar} as \$key => \${$singularVar}): ?>\n";
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
                        echo "\t\t\t\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?></td>\n";
                    }
                }

                echo "\t\t\t\t\t<td class=\"actions\">\n";
                    ?>
                        <div class="input-group">
                            <select class="form-control doneAction">
                                <option value="<?php echo "<?php echo \$this->Html->url(array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>"; ?>"><?php echo "<?php echo __('Edit') ?>"; ?></option>
                                <option value="<?php echo "<?php echo \$this->Html->url(array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>"; ?>"><?php echo "<?php echo __('View') ?>"; ?></option>
                                <option value="<?php echo "<?php echo \$this->Html->url(array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>"; ?>"><?php echo "<?php echo __('Delete') ?>"; ?></option>
                            </select>
                            <span class="input-group-btn doAction">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                        </div>
                    <?php
                echo "</td>\n";
            echo "\t\t\t\t</tr>\n";

            echo "\t\t\t<?php endforeach; ?>\n";
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php echo "<?php echo \$this->element('TwitterBootstrapAdmin.pagination'); ?>"; ?>


<?php echo "<?php \$this->start('related_actions'); ?>\n"; ?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo "<?php echo __('Actions'); ?>"; ?></div>
    <ul class="list-group">
        <?php echo "<?php echo \$this->Html->link(__('New " . $singularHumanName . "') . '<span class=\"pull-right glyphicon glyphicon-chevron-right\"></span>', array('action' => 'add'), array('class' => 'list-group-item', 'escape' => false)); ?>\n"; ?>
<?php
    $done = array();
    foreach ($associations as $type => $data) {
        foreach ($data as $alias => $details) {
            if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
                echo "\t\t<?php echo \$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "') . '<span class=\"pull-right glyphicon glyphicon-chevron-right\"></span>', array('controller' => '{$details['controller']}', 'action' => 'index'), array('class' => 'list-group-item', 'escape' => false)); ?>\n";
                echo "\t\t<?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "') . '<span class=\"pull-right glyphicon glyphicon-chevron-right\"></span>', array('controller' => '{$details['controller']}', 'action' => 'add'), array('class' => 'list-group-item', 'escape' => false)); ?>\n";
                $done[] = $details['controller'];
            }
        }
    }
?>
    </ul>
</div>
<?php echo "<?php \$this->end(); ?>\n"; ?>

<?php echo "<?php echo \$this->Html->script('TwitterBootstrapAdmin.doAction', array('inline' => false)); ?>"; ?>