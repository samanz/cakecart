<h2>Are you sure you want to delete <?php echo $product['Product']['name']; ?></h2>
<form action = "<?php echo $html->url('/admin/products/remove/' . $product['Product']['id']); ?>" method =  "post">
   <input name = "sent" value = "Yes" type = "submit" />
   <?php echo $html->link('No', '/admin/categories/show/' . implode('/', $this->params['bread'])); ?>
</form>