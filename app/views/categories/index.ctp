<h2>Categories</h2>
<ul>
   <?php foreach($categories as $category): ?>
      <li><?php echo $category['Category']['name']; ?>
         <?php if(count($category['SubCategory']) > 0): ?>
         <ul>
            <?php foreach($category['SubCategory'] as $subcat): ?>
               <li><?php echo $subcat['name']; ?>
            <?php endforeach; ?>
         </ul>
         <?php endif; ?>
         </li>
   <?php endforeach; ?>
</ul>