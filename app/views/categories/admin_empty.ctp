<h2><?php echo $category['Category']['name']; ?></h2>
<div id = "addcategory">
   <p><?php echo $html->link('New Category', '/admin/categories/add/' . implode('/', $this->params['bread'])); ?></p>
   <p class = "explain">If a category is added in this category, no products can be added to this category.</p>
</div>
<div id = "addproduct">
   <p><?php echo $html->link('New Product', '/admin/products/add/' . implode('/', $this->params['bread'])); ?></p>
   <p class = "explain">If a product is added in this category, no subcategories can be added to this category.</p>
</div>