<h2><?php echo $category['Category']['name']; ?></h2>
<table>
   <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Edit</th>
      <th>Move</th>
      <th>Remove</th>
   </tr>
   <?php $count = 1; ?>
   <?php foreach($category['SubCategory'] as $subcat): ?>
      <tr<?php if($count % 2 == 0) echo ' class = "alt" '; ?>>
         <td><?php echo $subcat['id']; ?></td>
         <td><?php echo $url->admin_cat_link($subcat['name'], $urls); ?></td>
         <td>Edit</td>
         <td>Move</td>
         <td>Remove</td>
      </tr>
   <?php $count++; ?>
   <?php endforeach; ?>
</table>