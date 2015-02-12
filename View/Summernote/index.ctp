<ul class="list-group">
    <?php foreach($files as $file): ?>
        <li class="list-group-item"><?php echo $this->Html->image('upload/' . $file); ?></li>
    <?php endforeach; ?>
</ul>