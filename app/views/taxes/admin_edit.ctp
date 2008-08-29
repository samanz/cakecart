<?php echo $form->create('Tax', array('action' => 'edit'));
   echo $form->hidden('id');
   echo $form->input('state', array('options' => Configure::read('Address.states')));
   echo $form->input('percent');
echo $form->end('Save');
?>