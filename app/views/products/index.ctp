<?php if(!empty($feat)): ?>
<h2>Featured Products</h2>
<div id = "featured">
<?php foreach($feat as $product): ?>
   <div class = "prod">
      <h3><?php echo $url->prod_link($product['Product'], '', false); ?></h3>
      <?php echo $url->fprods_image($product['Product']); ?>
   </div>
<?php endforeach;?>
</div>
<?php endif; ?>

<?php if(!empty($new)): ?>
<h2>New Products</h2>
<div id = "featured">
<?php foreach($new as $product): ?>
   <div class = "prod">
      <h3><?php echo $url->prod_link($product['Product'], '', false); ?></h3>
      <?php echo $url->fprods_image($product['Product']); ?>
   </div>
<?php endforeach;?>
</div>
<?php endif; ?>