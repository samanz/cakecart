<h2>Are you sure you want to delete User <?php echo $user['User']['first'] . ' ' . $user['User']['last']; ?></h2>
<form action = "<?php echo $html->url('/admin/users/remove/' . $user['User']['id']); ?>" method =  "post">
   <input name = "sent" value = "Yes" type = "submit" />
   <?php echo $html->link('No', '/admin/users/show/'); ?>
</form>