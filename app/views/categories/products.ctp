<h2><?php echo $category['Category']['name']; ?></h2>
<ul>
<?php foreach($products as $product): ?>
   <li>
      <h3><?php echo $url->prod_link($product['Product'], '', false); ?></h3>
      <?php echo $html->image(
                  'thumbs/'.$thumbnail->render(
                      $product['Product']['image'],
                      array(
                          'path'=>'products',
                          'width'=>Configure::read("Image.thumb_width"),
                          'height'=>Configure::read("Image.thumb_height"),
                          'quality'=>Configure::read("Image.thumb_quality")
                      )
                  )
              );
      ?>
      <dl>
         <dt>Price:</dt>
         <dd><?php echo $product['Product']['price']; ?></dd>
      </dl>
   </li>
<?php endforeach; ?>
</ul>