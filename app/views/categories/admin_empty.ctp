<h2><?php echo $category['Category']['name']; ?></h2>
<div id = "addcategory">
   <p><?php echo $html->link('Add Category', '/admin/categories/add/' . implode('/', $this->params['bread']), array('class'=>'button newCategory')); ?></p>
   <p class = "explain">If a category is added in this category, no products can be added to this category.</p>
</div>
<div id = "addproduct">
   <p><?php echo $html->link('Add Product', '/admin/products/add/' . implode('/', $this->params['bread']), array('class'=>'button newProduct')); ?></p>
   <p class = "explain">If a product is added in this category, no subcategories can be added to this category.</p>
</div>