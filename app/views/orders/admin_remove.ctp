<h2>Are you sure you want to delete Order #<?php echo $order['Order']['id']; ?></h2>
<form action = "<?php echo $html->url('/admin/orders/remove/' . $order['Order']['id']); ?>" method =  "post">
   <input name = "sent" value = "Yes" type = "submit" />
   <?php echo $html->link('No', '/admin/orders/show/'); ?>
</form>