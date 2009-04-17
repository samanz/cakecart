<h2>Your Shopping Cart</h2>
<table>
   <tr>
      <th>Remove</th>
      <th>Image</th>
      <th>Product</th>
      <th>Quantity</th>
      <th>Price</th>
   </tr>
   <?php foreach($cart['CartItems'] as $item): ?>
      <tr>
         <td>
            <?php echo $form->create('CartItem', array('action' => 'remove')); ?>
               <?php echo $form->input('id', array('type' => 'hidden', 'value' => $item['id'])); ?>
            <?php echo $form->end('Remove'); ?>
         </td>
         <td><?php echo $url->cart_image($item['Product']);?>
         <td><?php echo $url->prod_link($item['Product'], '', false); ?></td>
         <td>
            <?php echo $form->create('CartItem', array('action' => 'change')); ?>
               <?php echo $form->input('quantity', array('value' => $item['quantity'])); ?>
               <?php echo $form->input('id', array('type' => 'hidden', 'value' => $item['id'])); ?>
            <?php echo $form->end('Change'); ?>
            </td>
         <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
      </tr>
   <?php endforeach; ?>
   <tr>
      <td colspan = "4">Total</td>
      <td>$<?php echo number_format($total, 2); ?></td>
   </tr>
</table>
<?php echo $html->link('Checkout', '/checkout'); ?>