<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>
         CakeCart Administration Interface
      </title>
      <?php echo $html->css('admin'); ?>
   </head>
   <body<?php if(isset($current)) echo ' id = "' . $current . '" '; ?>>
      <div id = "wrapper">
         <div id="header">
            <a href = "<?php echo $html->url('/admin'); ?>"><?php echo $html->image('admin/logo.gif'); ?></a>
            <ul>
               <li><?php echo $html->link('View Site', '/', array('id' => 'view')); ?></li>
               <li><?php echo $html->link('Sign Out', '/admin/logout', array('id' => 'signout')); ?></li>
            </ul>
         </div>
         <ul id = "nav">
            <li><?php echo $html->link('Catalog', '/admin/categories', array('id' => 'Catalog')); ?></li>
            <li><?php echo $html->link('Orders', '/admin/orders', array('id' => 'Orders')); ?></li>
            <li><?php echo $html->link('Users', '/admin/users', array('id' => 'Users')); ?></li>
            <li><?php echo $html->link('Settings', '/admin/settings', array('id' => 'Settings')); ?></li>
         </ul>
         <div id = "main"<?php if(isset($sidebar)) echo ' class = "part" '?>>
            <?php if(isset($sidebar)): ?>
            <div id = "second">
               <?php foreach($sidebar as $side) echo $this->element($side); ?>
            </div>
            <?php endif; ?>
            <div id = "content"<?php if(isset($sidebar)) echo ' class = "part" '?>>
               <?php echo $content_for_layout; ?>
            </div>
         </div>
         <div id = "footer"><p>CakeCart Shopping Cart.</p></div>
      </div>
   </body>
</html>
