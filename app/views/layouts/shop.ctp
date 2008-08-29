<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>
         <?php echo Configure::read('Company.name'); ?> - <?php echo Configure::read('Company.slogan'); ?> - <?php echo $title_for_layout?>
      </title>
      <?php echo $scripts_for_layout ?>
      <?php echo $html->css('main'); ?>   
   </head>
   <body id="shop">
      <?php $session->flash(); ?>
      <div id = "header">
         <a href = "<?php echo $html->url('/'); ?>" title = "Go to Home Page">
            <?php echo $html->image('logo.gif', array('alt' => 'Sam\'s Telescopes')); ?>
         </a>
         <ul>
            <li><?php echo $html->link('Home', '/'); ?></li>
            <li><?php echo $html->link('Shopping Cart', '/carts'); ?></li>
            <li><?php echo $html->link('Checkout', '/checkout'); ?></li>
            <?php if($this->params['user']): ?>
            <li><?php echo $html->link('Sign Out', '/users/logout'); ?></li>
            <?php endif; ?>
         </ul>
      </div>
      <div id = "secondary">
         <?php echo $this->element('categories'); ?>
         <?php echo $this->element('smallcart'); ?>
      </div>
      <div id = "content">
         <?php echo $content_for_layout; ?>
      </div>
      <div id = "footer">
         <p>Copyright &copy; 2008 Sam's Telescopes inc</p> 
      </div>
   </body>
</html>
