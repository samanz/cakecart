<?php echo $form->create('User', array('action' => 'edit'));
   echo $form->input('first');
   echo $form->input('last');
   echo $form->input('email');
   echo $form->input('phone');
   echo $form->input('company');
echo $form->end('Create'); ?>