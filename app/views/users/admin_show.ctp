<h2>Viewing User <strong><?php echo $user['User']['first'] . ' ' . $user['User']['last']; ?></strong>:</h2>
<div id = "user_details">
   <h3>User Details</h3>
   <dl>
      <dt>Phone Number</dt>
      <dd><?php echo $user['User']['phone']; ?></dd>
      <dt>Email Address</dt>
      <dd><?php echo $user['User']['email']; ?></dd>
      <?php if($user['User']['company'] != ''): ?>
      <dt>Company</dt>
      <dd><?php echo $user['User']['company']; ?></dd>
      <?php endif; ?>
   </dl>
</div>
<?php if(!empty($user['Orders'])): ?>
<div id = "user_orders">
<h3>Orders:</h3>
<table>
   <tr>
      <th>Items</th>
      <th>Total Price</th>
      <th>View</th></th>
   </tr>
   <?php foreach($user['Orders'] as $order): ?>
      <?php $count = 0;?>
      <tr>
         <td><?php foreach($order['OrderItems'] as $item) $count++; echo $count; ?></td>
         <td>$<?php echo $onorder->total($order); ?></td>
         <td class = "ordView"><?php echo $html->link('View', '/admin/orders/show/' . $order['id']); ?></td>
      </tr>
   <?php endforeach; ?>
   </table>
</div>
<?php endif; ?>