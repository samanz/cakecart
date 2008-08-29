<h2>Taxes</h2>
<table class = "products">
	<tr>
		<th>State</th>
		<th>Percent</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>	
<?php $count = 0; ?>
<?php foreach($taxes as $tax): ?>
   <tr<?php if($count % 2 == 1) echo ' class = "alt" '?>>
      <td>
         <?php echo $tax['Tax']['state'];?>
      </td>
      <td>
         <?php echo $tax['Tax']['percent']; ?>
      </td>
      <td class = "taxEdit"><?php echo $html->link('Edit', '/admin/taxes/edit/' . $tax['Tax']['id']); ?></td>
      <td class = "taxDelete"><?php echo $html->link('Delete','/admin/taxes/remove/' . $tax['Tax']['id']); ?></td>
   </tr>
   <?php $count++;?>
<?php endforeach; ?>
</table>
<?php echo $html->link('New Tax State', '/admin/taxes/add', array('class'=> 'button newTax')); ?>