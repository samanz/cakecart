<h2>Your order has been placed.</h2>
<p>Your order has been successfully placed. Here are your order details:</p>
<table>
   <tr>
      <th>Image</th>
      <th>Product</th>
      <th>Quantity</th>
      <th>Price</th>
   </tr>
   <?php foreach($order['OrderItems'] as $item): ?>
      <tr>
         <td><?php echo $html->image('products/' . $item['Product']['image'], array('width' => '100'));?>
         <td><?php echo $url->prod_link($item['Product'], '', false); ?></td>
         <td><?php echo $item['quantity']; ?></td>
         <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
      </tr>
   <?php endforeach; ?>
   <tr>
      <td colspan = "3">Shipping</td>
      <td>$<?php echo number_format($order['Order']['shipping'], 2); ?></td>
   </tr>
   <?php if($order['Order']['tax'] > 0): ?>
      <tr>
         <td colspan = "3">tax</td>
         <td>$<?php echo number_format($order['Order']['tax'], 2); ?></td>
      </tr>
   <?php endif; ?>
   <tr>
      <td colspan = "3">Total</td>
      <td>$<?php echo number_format($total, 2); ?></td>
   </tr>
</table>
<div id = "address">
   <h3>Address</h3>
   <ul>
      <li><?php echo $order['Order']['first']; ?> <?php echo $order['Order']['last']; ?></li>
      <li><?php echo $order['Order']['address']; ?></li>
      <?php if($order['Order']['address2'] != ''): ?>
      <li><?php echo $order['Order']['address2']; ?></li>
      <?php endif; ?>
      <li><?php echo $order['Order']['city']; ?>, <?php echo $order['Order']['state']; ?> <?php echo $order['Order']['zip']; ?></li>
   </ul>
</div>