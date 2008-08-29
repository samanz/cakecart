<h2>Create New Tax State</h2>
<?php echo $form->create('Tax', array('action' => 'edit'));
   echo $form->input('state', array('options' => Configure::read('Address.states')));
   echo $form->input('percent');
echo $form->end('Save');
?>