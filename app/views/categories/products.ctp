<h2><?php echo $category['Category']['name']; ?></h2>
<ul>
<?php foreach($products as $product): ?>
   <li>
      <h3><?php echo $url->prod_link($product['Product'], '', false); ?></h3>
      <dl>
         <dt>Price:</dt>
         <dd><?php echo $product['Product']['price']; ?></dd>
      </dl>
   </li>
<?php endforeach; ?>
</ul>