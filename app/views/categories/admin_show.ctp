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
         <td><?php echo $html->link('Edit', '/admin/categories/edit/' . implode('/', $this->params['bread']) . '/' . $subcat['name']); ?></td>
         <td>Move</td>
         <td><?php echo $html->link('Remove', '/admin/categories/remove/' . implode('/', $this->params['bread']) . '/' . $subcat['name']); ?></td>
      </tr>
   <?php $count++; ?>
   <?php endforeach; ?>
</table>
<?php echo $html->link('New Category', '/admin/categories/add/' . implode('/', $this->params['bread'])); ?>