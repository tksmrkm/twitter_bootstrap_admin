<?php
$default = isset($type) ? $type : 'info';

$id = isset($id) ? $id : $default;
$id = $id . 'Message';

$class = isset($class) ? $class : 'alert alert-' . $default;
?><div id="<?php echo $id; ?>" class="<?php echo $class; ?>" role="alert"><?php echo h($message); ?></div>