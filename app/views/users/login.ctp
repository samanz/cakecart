<div id = "login">
   <h2>I've Been Here Before</h2>
   <p>Please login using your email and password. If you have forgotten yours or don't have a password, please click below to get a new one.</p>
<?php
    if  ($session->check('Message.auth')) $session->flash('auth');
    echo $form->create('User', array('action' => 'login'));
    echo $form->input('email');
    echo $form->input('password');
    echo $form->end('Login');
?>
</div>
<div id = "register">
   <h2>I Need to Register</h2>
   <p>Welcome to <?php echo Configure::read('Company.name'); ?>. Making a purchase us fast and easy to do.

   We just need your name, email and phone number. We'll store these details in your own customer account so that checkout is even quicker the next time you shop with us. You'll also be able to track your order and view your order history.

   Storing your details is safe and secure.</p>
   <?php echo $html->link('Register', '/users/register', array('class' => 'register')); ?>
</div>