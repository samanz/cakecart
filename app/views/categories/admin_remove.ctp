<h2>Are you sure you want to delete category <?php echo $category['Category']['name']; ?></h2>
<form action = "<?php echo $html->url('/admin/categories/remove/' . implode('/', $this->params['bread'])); ?>" method =  "post">
   <input name = "sent" value = "Yes" type = "submit" />
   <?php echo $html->link('No', '/admin/categories/show/' . $urls); ?>
</form>