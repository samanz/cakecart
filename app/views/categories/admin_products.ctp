<h2><?php echo $category['Category']['name']; ?></h2>
<table>
   <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>In Stock</th>
      <th>Edit</th>
      <th>Move</th>
      <th>Delete</th>
   </tr>
<?php $count = 1; ?>
<?php foreach($products as $product): ?>
   <tr<?php if($count % 2 == 0) echo ' class = "alt" '; ?>>
         <td><?php echo $product['Product']['id']; ?></td>
         <td class = "prodName"><?php echo $url->admin_prod_link($product['Product'], '', false); ?></td>
         <td>$<?php echo number_format($product['Product']['price'], 2); ?></td>
         <?php 
         $status = 'No';
         if($product['Product']['status'] == 1)
            $status = 'Yes';
         if($product['Product']['status'] == 2)
            $status = 'Disabled';
         ?>
         <td><?php echo $status; ?></td>
         <td class = "prodEdit"><?php echo $url->admin_prod_link($product['Product'], '', false, false); ?></td>
         <td class = "prodMove">Move</td>
         <td class = "prodRemove"><?php echo $html->link('Remove', '/admin/products/remove/' . $product['Product']['id']); ?></td>
   </tr>
   <?php $count++; ?>
<?php endforeach; ?>
</table>
<?php echo $html->link('New Product', '/admin/products/add/' . implode('/', $this->params['bread']), array('class'=> 'button newProduct')); ?>