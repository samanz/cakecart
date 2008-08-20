<h2><?php echo $category['Category']['name']; ?></h2>
<ul>
   <?php foreach($category['SubCategory'] as $subcat): ?>
      <li><?php echo $url->cat_link($subcat['name'], $urls); ?></li>
   <?php endforeach; ?>
</ul>