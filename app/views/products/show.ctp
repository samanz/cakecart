<h2><?php echo $product['Product']['name']; ?></h2>
<p id = "model"><?php echo $product['Product']['model']; ?></p>
<div id = "image">
   <?php echo $html->image('products/' . $product['Product']['image']); ?>
</div>
<div id = "description">
   <?php echo $product['Product']['description']; ?>
</div>
<dl id = "price">
   <dt><strong>Price:</strong></dt>
   <dd>$<?php echo number_format($product['Product']['price'], 2 ); ?>
</dl>
<?php echo $form->create('CartItem', array('action' => 'add')); ?>
   <?php echo $form->input('quantity', array('label' => 'Quantity: ', 'value' => '1')); ?>
   <?php echo $form->input('product_id', array('type' => 'hidden', 'value' => $product['Product']['id'])); ?>
<?php echo $form->end('Add To Cart'); ?>