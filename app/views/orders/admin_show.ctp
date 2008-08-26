<h2>Address</h2>
<p><?php echo $order['Order']['first'] . ' ' . $order['Order']['last']; ?></p>
<p><?php echo $order['Order']['address']; ?></p>
<?php if($order['Order']['address2'] != '') echo '<p>' . $order['Order']['address2'] . '</p>'; ?>
<p><?php echo $order['Order']['city'] . ', ' . $order['Order']['state'] . ' ' . $order['Order']['zip']; ?></p>

<h2>Payment Details</h2>
<dl>
   <dt>Payment Method:</dt>
   <?php if($order['Order']['payment_method'] == 1): ?>
   <dd>Paypal</dd>
   <dt>Completed Date</dt>
   <dd>Time</dd>
   <?php elseif($order['Order']['payment_method'] == 0): ?>
   <dd>Credit Card</dd>
   <dt>Credit Card Number</dt>
   <dd>410000000000000000000</dd>
   <dt>Credit Card Expire</dt>
   <dd>10/22</dd>
   <dt>CVV</dt>
   <dd>316</dd>
   <?php elseif($order['Order']['payment_method'] == 2): ?>
   <dd>Google Checkout</dd>
   <dt>Completed Date</dt>
   <dd>Time</dd>
   <?php endif; ?>
</dl>
<h2>Order Items</h2>
<table>
   <tr>
      <th>Quantity</th>
      <th>Model</th>
      <th>Item Name</th>
      <th>Price</th>
   </tr>
   <?php $count = 0; ?>
   <?php foreach($order['OrderItems'] as $item): ?>
   <tr<?php if($count % 2 == 1) echo ' class = "alt" ';?>>
      <td><?php echo $item['quantity']; ?></td>
      <td><?php echo $item['Product']['model']; ?></td>
      <td><?php echo $item['Product']['name']; ?></td>
      <td>$<?php echo $item['price']; ?></td>
   </tr>
   <?php $count++ ?>
   <?php endforeach; ?>
   <tr>
      <td colspan = "2"></td>
      <td>Shipping:</td>
      <td>$<?php echo $order['Order']['shipping']; ?></td>
   </tr>
   <tr>
      <td colspan = "2"></td>
      <td>Tax:</td>
      <td>$<?php echo $order['Order']['tax']; ?></td>
   </tr>
   <tr>
      <td colspan = "2"></td>
      <td>Total:</td>
      <td>$<?php echo $onorder->total($order); ?></td>
   </tr>
</table>
   