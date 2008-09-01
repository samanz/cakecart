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
$alt = '';
foreach($coupons as $coupon): ?>
   <tr<?php echo $alt; ?>>
      <td>
         <?php echo $coupon['Coupon']['code'];?>
      </td>
      <td>
         <?php echo $coupon['Coupon']['description']; ?>
      </td>
      <td>
         <?php
         $today = strtotime("now");
         $end = strtotime($coupon['Coupon']['end']);
         $start = strtotime($coupon['Coupon']['start']);
         $current = 'No';
         if ($end > $today && $today > $start) $current = "Yes";
         echo $current;
         ?>
      </td>
      <td class = "couEdit">
         <?php echo $html->link('Edit','/admin/coupons/edit/' . $coupon['Coupon']['id']); ?>
      </td>
      <td class = "couDelete">
         <?php echo $html->link('Delete','/admin/coupons/remove/' . $coupon['Coupon']['id']); ?>
      </td>
   </tr>
<?php
if($alt == '') { $alt = ' class = "alt" '; } else { $alt = ''; }
endforeach;
?>
</table>
<?php echo $html->link('Add Coupon', '/admin/coupons/add', array('class'=>'button addCoupon')); ?>
