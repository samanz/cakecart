<?php echo $this->element('admin_viewing'); ?>
<table>
   <tr>
      <th>Id</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Total</th>
      <th>Status</th>
      <th>View</th>
      <th>Edit</th>
      <th>Delete</th>
   </tr>
   <?php $count = 0; ?>
   <?php foreach($orders as $order): ?>
   <tr <?php if($count % 2 == 1) echo ' class = "alt" '; ?>>
      <td><?php echo $order['Order']['id']; ?></td>
      <td><?php echo $order['User']['first']; ?></td>
      <td><?php echo $order['User']['last']; ?></td>
      <td>$<?php echo $onorder->total($order); ?></td>
      <td><?php echo $onorder->status($order); ?></td>
      <td class = "ordView"><?php echo $html->link('View', '/admin/orders/show/' . $order['Order']['id']); ?></td>
      <td class = "ordEdit"><?php echo $html->link('Edit', '/admin/orders/edit/' . $order['Order']['id']); ?></td>
      <td class = "ordDel"><?php echo $html->link('Delete', '/admin/orders/remove/' . $order['Order']['id']); ?></td>
      <?php $count++ ?>
   </tr>
   <?php endforeach; ?>
</table>