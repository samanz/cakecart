<?php
   echo $form->create('User', array('action' => 'add_admin'));
   echo $form->input('email');
   echo $form->input('password');
   echo $form->input('password2', array('type'=>'password'));
   echo $form->input('first');
   echo $form->input('last');
   echo $form->input('phone');
   echo $form->end('Register');
?>