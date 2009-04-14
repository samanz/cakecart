<?php
class CategoriesController extends AppController {
	var $name = 'Categories';
	var $layout = 'shop';
	var $uses = array('Category', 'Product');
	var $components = array('Url', 'Session', 'Imagef');
	var $helpers = array('Url', 'Html', 'Thumbnail');
	
	function beforeFilter() {
	   $this->setUser();
	   $this->Auth->authError = 'Login to Access Administration';
	   if(@$this->params['admin'] != 1)
	      $this->Auth->allow('*');
	}
	
	function direct() {
	   $this->redirect('/admin/categories');
	}
	
	function _getCategory($admin = false, $append = '') {
	   if($admin) $replace = "admin/categories/" . $append;
	   else $replace = "category/" . $append;
	   $this->Category->bindModel( array('hasMany'=> array('Products')));
		$url = str_replace($replace, '', $this->params['url']['url']);
		$category = $this->Category->find(array('Category.url' => $url));
		$this->params['bread'] = explode('/', $url);
		$this->params['ids'] = explode('/', $category['Category']['ids']);
		$this->set('category', $category);
		$this->set('urls', $url);
		return $category;
	}
	
	function admin_index() {
	   $this->layout = 'admin';
	   $this->set('current', 'catalog');
	   $this->set('sidebar', array('admin_categories'));
	   $this->Category->unbindModel(
         array('hasMany' => array('Products', 'SubCategory'))
      );
		$categories = $this->Category->find('all', array('conditions' => array('Category.parent_id' => '0')) );
		$this->params['ids'] = array();
		$this->params['bread'] = array();
		$this->set('urls', '');
		$this->set('categories', $categories);
	}
	
	function admin_slugifyall() {
	   $cats = $this->Category->find('all');
	   foreach($cats as $cat) {
	      if($cat['Category']['url'] == '' || $cat['Category']['ids'] == '') {
	         $this->data['Category']['id'] = $cat['Category']['id'];
	         $this->data['Category']['ids'] = $this->Url->getCategoryIds($cat['Category']['id']);
	         $this->data['Category']['url'] = $this->Url->getCategoryUrl($cat['Category']['id']);
	         $this->Category->save($this->data);
	      }
	   }
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
		$category = $this->_getCategory();
		$id = $category['Category']['id'];
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
	   $category = $this->_getCategory(true, 'show/');
		$id = $category['Category']['id'];
		if(isset($category['Products'][0])) {
			$products = $this->Product->find('all', array('conditions' =>
					array('Product.category_id' => $id)
				));
			$this->set('products', $products);
			$this->render('admin_products');
		} else {
		   if(!isset($category['SubCategory'][0]))
		      $this->render('admin_empty');
		}
	}
	function admin_add() {
	   $this->layout = 'admin';
	   $this->set('current', 'catalog');
	   $category = $this->_getCategory(true, 'add/');
		$id = $category['Category']['id'];
		$slug = $this->Url->getCategoryUrl($id);
		$ids  = $this->Url->getCategoryIds($id);
		if(strlen($slug) > 0) $slug .= '/';
		if(empty($this->data)) $this->data['Category']['url'] = $slug;
      else {
         $this->data['Category']['url'] = $slug . Inflector::slug($this->data['Category']['name']);
         $this->data['Category']['ids'] = $ids;
         if($this->Imagef->check($this->data['Category']['image_url'])) {
	         $this->data['Category']['image'] = $this->Imagef->saveCat( $this->data['Category']['image_url'] );
	      }
         $this->data['Category']['parent_id'] = $id;
         if($this->Category->save($this->data)) {
            $this->Session->setFlash('Category Added');
            $this->redirect('/admin/categories/show/' . $urls);
         }
      }
	}
	function admin_edit() {
	   $this->layout = 'admin';
	   $this->set('current', 'catalog');
	   $category = $this->_getCategory(true, 'edit/');
		$id = $category['Category']['id'];
	   if(empty($this->data)) {
	      $this->Category->id = $id;
	      $this->data = $this->Category->read();
	   } else {
	      if($this->Imagef->check($this->data['Category']['image_url'])) {
	         $this->data['Category']['image'] = $this->Imagef->saveCat( $this->data['Category']['image_url'] );
	      }
	      $slug = $this->Url->getCategoryUrl($this->data['Category']['parent_id']);
   		if(strlen($slug) > 0) $slug .= '/';
	      $this->data['Category']['url'] = $slug . $this->data['Category']['name'];
         if($this->Category->save($this->data)) {
            $this->Session->setFlash('Category Edited');
            $url = $this->Url->removeLast($urls);
            $this->redirect('/admin/categories/show/' . $url);
         }
	   }
	}
	
	function admin_remove() {
	   $this->layout = 'admin';
	   $this->set('current', 'catalog');
	   $category = $this->_getCategory(true, 'remove/');
		$id = $category['Category']['id'];
	   if(!isset($_POST['sent'])) {
	      $this->set('urls', $this->Url->removeLast($urls));
	      $category = $this->Category->find(array('Category.id' => $id));
	      $this->set('category', $category);
	   } else {
	      $this->Category->del($id);
	      $this->Session->setFlash('Category Deleted');
	      $url = $this->Url->removeLast($urls);
	      $this->redirect('/admin/categories/show/' . $url);
	   }
	}
	
	function admin_move() {
	   $this->layout = 'admin';
	   $this->set('current', 'catalog');
	   $category = $this->_getCategory(true, 'move/');
		$id = $category['Category']['id'];
	   if(empty($this->data)){
         $this->Category->id = $id;
         $this->data = $this->Category->read();
         $options = $this->Category->selectTree($this->data['Category']['id']);
         $this->set('options', $options);
      } else {
	      $slug = $this->Url->getCategoryUrl($this->data['Category']['parent_id']);
	      $ids = $this->Url->getCategoryIds($this->data['Category']['parent_id']);
   		if(strlen($slug) > 0) $slug .= '/';
   		if(strlen($ids) > 0) $ids .= '/';
	      $this->data['Category']['url'] = $slug . $this->data['Category']['name'];
	      $this->data['Category']['ids'] = $ids . $this->data['Category']['id'];
         if($this->Category->save($this->data)) {
      	   $this->Session->setFlash('Category Moved');
            $url = $this->Url->removeLast($urls);
            $this->redirect('/admin/categories/show/' . $url);
         }
      }
	}
	
}
?>