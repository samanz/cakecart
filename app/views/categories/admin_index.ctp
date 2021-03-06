<h2 id = "catName">Top-Level Categories</h2>
<?php echo $this->element('admin_search'); ?>
<table>
   <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Edit</th>
      <th>Move</th>
      <th>Remove</th>
   </tr>
   <?php $count = 1; ?>
   <?php foreach($categories as $cat): ?>
      <tr<?php if($count % 2 == 0) echo ' class = "alt" '; ?>>
         <td><?php echo $cat['Category']['id']; ?></td>
         <td class = "catName"><?php echo $url->admin_cat_link($cat['Category']['name'], $urls); ?></td>
         <td class = "catEdit"><?php echo $html->link('Edit', '/admin/categories/edit/' . implode('/', $this->params['bread']) . '/' . $cat['Category']['name']); ?></td>
         <td class = "catMove"><?php echo $html->link('Move', '/admin/categories/move/' . implode('/', $this->params['bread']) . '/' . $cat['Category']['name']); ?></td>
         <td class = "catRemove"><?php echo $html->link('Remove', '/admin/categories/remove/' . implode('/', $this->params['bread']) . '/' . $cat['Category']['name']); ?></td>
      </tr>
   <?php $count++; ?>
   <?php endforeach; ?>
</table>
<?php echo $html->link('New Category', '/admin/categories/add/' . implode('/', $this->params['bread']), array('class' => 'button newCategory')); ?>