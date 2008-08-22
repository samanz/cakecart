<h2>Editing Category <?php echo implode(' -> ', $this->params['bread'])?></h2>
<?php echo $form->create('Category', array('type' => 'file', 'url' => '/admin/categories/edit/' . implode('/', $this->params['bread']))); ?>
<?php echo $form->hidden('id'); ?>
<?php echo $form->input('name'); ?>
<?php echo $form->input('image_url', array('type'=>'file')); ?>
<?php echo $form->end('Save'); ?>