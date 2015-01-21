<p>
<?php
    echo $this->Paginator->counter(array(
        'format' => 'Pages: {:page}/{:pages}, Records: {:start}-{:end}/{:count}'
    ));
?>
</p>
<ul class="pagination">
    <?php
        echo $this->Paginator->prev('< 前', array('tag' => 'li'), null, array('class' => 'prev disabled', 'tag' => 'li', 'disabledTag' => 'span'));
        echo $this->Paginator->numbers(array('before' => '<li>', 'after' => '</li>', 'separator' => '</li><li>'));
        echo $this->Paginator->next('次 >', array('tag' => 'li'), null, array('class' => 'next disabled', 'tag' => 'li', 'disabledTag' => 'span'));
    ?>
</ul>
