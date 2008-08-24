<h2>Move <?php echo $this->data['Product']['name']; ?> to:</h2>
<?php echo $form->create('Product', array('action'=>'move/' . $this->data['Product']['id'])); ?>
<?php echo $form->hidden('id'); ?>
<?php echo $form->input('category_id', array('options'=> $options)); ?>
<?php echo $form->end('move'); ?>