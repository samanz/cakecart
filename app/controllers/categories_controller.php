<?php
class CategoriesController extends AppController {
	var $name = 'Categories';
	var $layout = 'shop';
	var $uses = array('Category', 'Product');
	var $components = array('Url', 'Session');
	var $helpers = array('Url', 'Html');
	
	function admin_index() {
	   $this->layout = 'admin';
	   $this->set('current', 'catalog');
	   $this->set('sidebar', array('admin_categories'));
	}
	function index() {
		if (isset($this->params['requested'])) {
			$categories = $this->Category->getTree();
		 	return $categories;
	  } else {
			$categories = $this->Category->theRoots();
			$this->set('categories', $categories);
		 }
	}
	function show() {
		list($id,$ids, $urls) = $this->Url->parents($this->params['pass']);
		$this->params['ids'] = explode('/', $ids);
		$this->params['bread'] = explode('/', $urls);
		$category = $this->Category->find(array('Category.id' => $id));
		$this->set('category', $category);
		$this->set('urls', $urls);
		if(isset($category['Products'][0])) {
			$products = $this->Product->find('all', array('conditions' =>
					array('Product.category_id' => $id)
				));
			$this->set('products', $products);
			$this->render('products');
		}
	}
	function admin_show() {
	   $this->layout = 'admin';
	   $this->set('current', 'catalog');
	   $this->set('sidebar', array('admin_categories'));
		list($id,$ids, $urls) = $this->Url->parents($this->params['pass']);
		$this->params['ids'] = explode('/', $ids);
		$this->params['bread'] = explode('/', $urls);
		$category = $this->Category->find(array('Category.id' => $id));
		$this->set('category', $category);
		$this->set('urls', $urls);
		if(isset($category['Products'][0])) {
			$products = $this->Product->find('all', array('conditions' =>
					array('Product.category_id' => $id)
				));
			$this->set('products', $products);
			$this->render('admin_products');
		}
	}
	
}
?>