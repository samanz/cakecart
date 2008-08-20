<div id = "smallcart">
   <h2>Shopping Cart <?php echo $html->link('-Edit', '/carts'); ?></h2>
   <?php list($cart, $total) = $this->requestAction('carts/getCart'); ?>
   <?php if(isset($cart['CartItems'][0])): ?>
   <table>
      <tr>
         <th>Quantity</th>
         <th>Name</th>
         <th>Price</th>
      </tr>
      <?php foreach($cart['CartItems'] as $item): ?>
      <tr>
         <td><?php echo $item['quantity']; ?></td>
         <td><?php echo $item['Product']['name']; ?></td>
         <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
      </tr>
      <?php endforeach; ?>
      <tr>
         <td colspan = "2">Total: </td>
         <td>$<?php echo number_format($total, 2); ?></td>
      </tr>
   </table>
   <?php else: ?>
   <p>Your Shopping Cart is Currently Empty.</p>
   <?php endif; ?>
</div>