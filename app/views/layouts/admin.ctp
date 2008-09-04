<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>
         CakeCart Administration Interface
      </title>
      <?php echo $html->css('admin'); ?>
      <script type="text/javascript" src="<?php echo $html->url('/js/jquery-1.2.3.min.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo $html->url('/js/jquery.manyform.min.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo $html->url('/js/jquery.datePicker.js'); ?>"></script>
      <!--[if lte IE 6]>
         <?php echo $html->css('aie'); ?>
		<![endif]-->
		<!--[if gte IE 7]> 
		   <style type="text/css">
		      div.radio label { float:right; padding:12px; clear:right; width:240px; }
		   </style>
      <![endif]-->
		<!--[if lt IE 8]>
         <style type="text/css">
            #second li a {display:inline-block;}
            #second li a {display:block;}
            #second li strong {display:inline-block;}
            #second li strong {display:block;}
         </style>
      <![endif]-->
      
   </head>
   <body<?php if(isset($current)) echo ' id = "' . $current . '" '; ?><?php if(isset($sidebar)) echo ' class = "part" '?>>
      <div id = "wrapper">
         <div id="header">
            <a href = "<?php echo $html->url('/admin'); ?>"><?php echo $html->image('admin/logo.gif'); ?></a>
            <ul>
               <li><?php echo $html->link('View Site', '/', array('id' => 'view')); ?></li>
               <li><?php echo $html->link('Sign Out', '/admin/users/logout', array('id' => 'signout')); ?></li>
            </ul>
         </div>
         <ul id = "nav">
            <li><?php echo $html->link('Catalog', '/admin/categories', array('id' => 'Catalog')); ?></li>
            <li><?php echo $html->link('Orders', '/admin/orders', array('id' => 'Orders')); ?></li>
            <li><?php echo $html->link('Users', '/admin/users', array('id' => 'Users')); ?></li>
            <li><?php echo $html->link('Settings', '/admin/settings', array('id' => 'Settings')); ?></li>
         </ul>
         <div id = "main"<?php if(isset($sidebar)) echo ' class = "part" '?>>
            <div id = "content"<?php if(isset($sidebar)) echo ' class = "part" '?>>
               <div class = "padding">
                  <?php echo $content_for_layout; ?>
               </div>
            </div>
            <?php if(isset($sidebar)): ?>
            <div id = "second">
               <?php foreach($sidebar as $side) echo $this->element($side); ?>
            </div>
            <?php endif; ?>
         </div>
         <div id="clearfooter"></div>
      </div>
      <div id = "footer"><p>CakeCart Shopping Cart.</p></div>
   </body>
</html>
