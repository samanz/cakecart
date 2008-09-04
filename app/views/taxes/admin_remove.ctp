<h2>Are you sure you want to delete tax <?php echo $tax['Tax']['state']; ?>:</h2>
<form action = "<?php echo $html->url('/admin/taxes/remove/' . $tax['Tax']['id']); ?>" method =  "post">
   <input name = "sent" value = "Yes" type = "submit" />
   <?php echo $html->link('No', '/admin/taxes/'); ?>
</form>