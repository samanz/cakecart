<h2>Products</h2>
<?php foreach($products as $product): ?>
   <?php echo $product['Product']['name']; ?> <br />
   <?php echo $url->fprods_image($product['Product']); ?> <br />
<?php endforeach;?>