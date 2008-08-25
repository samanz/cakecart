<?php
class CategoriesController extends AppController {
	var $name = 'Categories';
	var $layout = 'shop';
	var $uses = array('Category', 'Product');
	var $components = array('Url', 'Session', 'Image');
	var $helpers = array('Url', 'Html');
	
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
		$this->Category->bindModel( array('hasMany'=> array('Products')));
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
		if(strlen($urls) == 0) {
		   $this->redirect('/admin/categories/');
		   exit();
		}
		$this->params['ids'] = explode('/', $ids);
		$this->params['bread'] = explode('/', $urls);
		$this->Category->bindModel( array('hasMany'=> array('Products')));
		$category = $this->Category->find(array('Category.id' => $id));
		$this->set('category', $category);
		$this->set('urls', $urls);
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
	   list($id,$ids, $urls) = $this->Url->parents($this->params['pass']);
		$this->params['ids'] = explode('/', $ids);
		if(strlen($urls) == 0)
		   $this->params['bread'] = array();
		else
		   $this->params['bread'] = explode('/', $urls);
      if(!empty($this->data)) {
         if($this->Image->check($this->data['Category']['image_url'])) {
	         $this->data['Category']['image'] = $this->Image->saveCat( $this->data['Category']['image_url'] );
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
	   list($id,$ids, $urls) = $this->Url->parents($this->params['pass']);
		$this->params['ids'] = explode('/', $ids);
		$this->params['bread'] = explode('/', $urls);
	   if(empty($this->data)) {
	      $this->Category->id = $id;
	      $this->data = $this->Category->read();
	   } else {
	      if($this->Image->check($this->data['Category']['image_url'])) {
	         $this->data['Category']['image'] = $this->Image->saveCat( $this->data['Category']['image_url'] );
	      }
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
	   list($id,$ids, $urls) = $this->Url->parents($this->params['pass']);
		$this->params['ids'] = explode('/', $ids);
		$this->params['bread'] = explode('/', $urls);
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
	   list($id,$ids, $urls) = $this->Url->parents($this->params['pass']);
		$this->params['ids'] = explode('/', $ids);
		$this->params['bread'] = explode('/', $urls);
	   if(empty($this->data)){
         $this->Category->id = $id;
         $this->data = $this->Category->read();
         $options = $this->Category->selectTree($this->data['Category']['id']);
         $this->set('options', $options);
      } else {
         if($this->Category->save($this->data)) {
      	   $this->Session->setFlash('Category Moved');
            $url = $this->Url->removeLast($urls);
            $this->redirect('/admin/categories/show/' . $url);
         }
      }
	}
	
}
?>