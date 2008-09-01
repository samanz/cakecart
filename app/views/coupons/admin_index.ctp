<h2>Coupon Codes</h2>
<table class = "products">
	<tr>
		<th>Coupon Code</th>
		<th>Description</th>
		<th>Current</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>	
<?php 
$count = 0;
foreach($coupons as $coupon): ?>
   <tr<?php if($count % 2 == 1) echo ' class = "alt" ';?>>
      <td>
         <?php echo $coupon['Coupon']['code'];?>
      </td>
      <td>
         <?php echo $coupon['Coupon']['description']; ?>
      </td>
      <td>
         <?php if($coupon['Coupon']['current']):?>Current<?php else: ?>Expired<?php endif; ?>
      </td>
      <td class = "couEdit">
         <?php echo $html->link('Edit','/admin/coupons/edit/' . $coupon['Coupon']['id']); ?>
      </td>
      <td class = "couDelete">
         <?php echo $html->link('Delete','/admin/coupons/remove/' . $coupon['Coupon']['id']); ?>
      </td>
   </tr>
<?php
$count++;
endforeach;
?>
</table>
<?php echo $html->link('Add Coupon', '/admin/coupons/add', array('class'=>'button addCoupon')); ?>
