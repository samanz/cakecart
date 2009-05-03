<h2>Order #<?php echo $order['Order']['id']; ?> - Status: <?php echo $onorder->status($order); ?></h2>
<div id = "bill_to">
   <h3>Billing Address</h3>
   <p><?php echo $order['User']['first'] . ' ' . $order['User']['last']; ?></p>
   <p><?php echo $order['Order']['bill_address']; ?></p>
   <?php if($order['Order']['bill_address2'] != '') echo '<p>' . $order['Order']['bill_address2'] . '</p>'; ?>
   <p><?php echo $order['Order']['bill_city'] . ', ' . $order['Order']['bill_state'] . ' ' . $order['Order']['bill_zip']; ?></p>
</div>

<div id = "ship_to">
   <h3>Shipping Address</h3>
   <p><?php echo $order['User']['first'] . ' ' . $order['User']['last']; ?></p>
   <p><?php echo $order['Order']['address']; ?></p>
   <?php if($order['Order']['address2'] != '') echo '<p>' . $order['Order']['address2'] . '</p>'; ?>
   <p><?php echo $order['Order']['city'] . ', ' . $order['Order']['state'] . ' ' . $order['Order']['zip']; ?></p>
</div>
<div id = "user_details">
   <h3>User Details</h3>
   <dl>
      <dt>Phone Number</dt>
      <dd><?php echo $order['User']['phone']; ?></dd>
      <dt>Email Address</dt>
      <dd><?php echo $order['User']['email']; ?></dd>
      <dt>Ip Address</dt>
      <dd>172.345.321.333</dd>
   </dl>
</div>
<div id = "payment">
   <h3>Payment Details</h3>
   <dl>
      <dt>Payment Method</dt>
      <?php if($order['Order']['payment_method'] == 1): ?>
      <dd>Paypal</dd>
      <dt>Completed Date</dt>
      <dd>Time</dd>
      <?php elseif($order['Order']['payment_method'] == 0): ?>
      <dd>Credit Card</dd>
      <dt>Credit Card Number</dt>
      <dd><?php echo $order['Order']['credit_number']; ?></dd>
      <dt>Credit Card Expire</dt>
      <dd><?php echo $order['Order']['credit_month'] . '/' .  $order['Order']['credit_year']; ?></dd>
      <dt>CVV</dt>
      <dd><?php echo $order['Order']['credit_cvv']; ?></dd>
      <?php elseif($order['Order']['payment_method'] == 2): ?>
      <dd>Google Checkout</dd>
      <dt>Completed Date</dt>
      <dd>Time</dd>
      <?php endif; ?>
   </dl>
</div>
<div id = "items">
   <h3>Order Items</h3>
   <table>
      <tr>
         <th>Quantity</th>
         <th>Model</th>
         <th>Item Name</th>
         <th class = "price">Price</th>
      </tr>
      <?php $count = 0; ?>
      <?php foreach($order['OrderItems'] as $item): ?>
      <tr<?php if($count % 2 == 1) echo ' class = "alt" ';?>>
         <td><?php echo $item['quantity']; ?></td>
         <td><?php echo $item['Product']['model']; ?></td>
         <td><?php echo $item['Product']['name']; ?></td>
         <td class = "price">$<?php echo $item['price']; ?></td>
      </tr>
      <?php $count++ ?>
      <?php endforeach; ?>
      <tr class = "info">
         <td colspan = "3">Shipping Method:</td>
         <td><?php echo ucwords($order['Order']['shipping_method']); ?></td>
      </tr>
      <tr class = "info">
         <td colspan = "3">Shipping:</td>
         <td><?php echo $onorder->format($order['Order']['shipping']); ?></td>
      </tr>
      <tr class = "info">
         <td colspan = "3">Tax:</td>
         <td><?php echo $onorder->format($order['Order']['tax']); ?></td>
      </tr>
      <tr class = "info">
         <td colspan = "3">Total:</td>
         <td><?php echo $onorder->format($total); ?></td>
      </tr>
   </table>
</div>