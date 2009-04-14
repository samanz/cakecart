<h2>Move <?php echo $this->data['Category']['name']; ?> to:</h2>
<?php echo $form->create('Category', array('url'=>'/admin/categories/move/' . implode('/', $this->params['bread']))); ?>
<?php echo $form->hidden('id'); ?>
<?php echo $form->hidden('name'); ?>
<?php echo $form->input('parent_id', array('options'=> $options)); ?>
<?php echo $form->end('move'); ?>