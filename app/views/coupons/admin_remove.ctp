<h2>Are you sure you want to delete Coupon <?php echo $coupon['Coupon']['code']; ?></h2>
<form action = "<?php echo $html->url('/admin/coupons/remove/' . $coupon['Coupon']['id']); ?>" method =  "post">
   <input name = "sent" value = "Yes" type = "submit" />
   <?php echo $html->link('No', '/admin/coupons/'); ?>
</form>