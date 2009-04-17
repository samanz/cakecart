<h2>Products</h2>
<div id = "featured">
<?php foreach($products as $product): ?>
   <div class = "prod">
      <h3><?php echo $url->prod_link($product['Product'], '', false); ?></h3>
      <?php echo $url->fprods_image($product['Product']); ?>
   </div>
<?php endforeach;?>
</div>