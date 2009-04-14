<?php
class ProductsController extends AppController {
	var $name = 'Products';
	var $layout = 'shop';
	var $components = array('Url', 'Session', 'Imagef');
	var $helpers = array('Html', 'Url');
	var $uses = array('Product', 'Category', 'Image');
	
	function beforeFilter() {
	   $this->setUser();
	   if(@$this->params['admin'] != 1)
	      $this->Auth->allow('*');
	}
	
	function index() {
		$this->set('products', $this->Product->find('all'));
	}
	function show($id = null) {
		$product = $this->Product->find(array('Product.id' => $id));
	   list($ids, $url) = $this->Url->getUrl($product['Product']['id']);
		$this->params['bread'] = array_reverse($url);
		$this->params['ids'] = array_reverse($ids);
		$this->params['ids'][] = 'product';
		$this->set('product', $product);
	}
	
	function admin_add() {
	   $this->layout = 'admin';
	   $this->set('current', 'catalog');
		list($id,$ids, $urls) = $this->Url->parents($this->params['pass']);
		$this->params['bread'] = explode('/', $urls);
	   if(!empty($this->data)) {
         if($this->Imagef->check($this->data['Product']['image_url'])) {
	         $this->data['Product']['image'] = $this->Imagef->save( $this->data['Product']['image_url'] );
	      }
	      $this->data['Product']['category_id'] = $id;
	      if($this->Product->save($this->data)) {
	         $product_id = $this->Product->getLastInsertId();
	         $this->_addImages($product_id, $this->data);
	         $this->Session->setFlash('Product Added');
	         $this->redirect('/admin/categories/show/' . $urls);
	      }
	      
	   }
	}
	
	function _addImages($product_id, $cdata) {
	      if(@$cdata['Image']['1'] != '') {
            foreach($cdata['Image'] as $image) {
 		   	   $data['Image']['image'] =  $this->Imagef->save($image);
 		   	   $data['Image']['product_id'] = $product_id;
 		   	   if(!$this->Image->save($data)) {
 		   		   die('Could not write data');
 		   	   }
 		   	   $this->Image->id = false;
 		   	}
 		   }
	}
	
	function _removeImages($form) {
	   foreach($form['delimage'] as $image) {
			if($image['del'] == 1)
				$this->Image->del($image['id']);
		}
	}
	
	function admin_edit($id = null) {
	   $this->layout = 'admin';
	   $this->set('current', 'catalog');
	   $this->set('sidebar', array('admin_product'));
	   list($ids, $url) = $this->Url->getUrl($id);
	   $url = array_reverse($url);
	   if(empty($this->data)) {
	      $this->Product->id = $id;
	      $this->Product->recursive = 2;
	      $this->data = $this->Product->read();
	   } else {
	      if($this->Imagef->check($this->data['Product']['image_url'])) {
	         $this->data['Product']['image'] = $this->Imagef->save($this->data['Product']['image_url']);	
	      }		
	      if($this->Product->save($this->data)) {
	         $product_id = $this->data['Product']['id'];
	         $this->_removeImages($this->params['form']);
	         $this->_addImages($product_id, $this->data);
	         $this->Session->setFlash('Product Edited');
	         $this->redirect('/admin/categories/show/' . implode('/', $url));
	      }
	   }
	}
	
	function admin_remove($id = null) {
	   $this->layout = 'admin';
	   $this->set('current', 'catalog');
	   list($ids, $url) = $this->Url->getUrl($id);
	   $url = array_reverse($url);
	   $this->params['bread'] = $url;
	   if(!isset($_POST['sent'])) {
	      $product = $this->Product->find(array('Product.id' => $id));
	      $this->set('product', $product);
	   } else {
	      $this->Product->del($id);
	      $this->Session->setFlash('Product Deleted');
	      $this->redirect('/admin/categories/show/' . implode('/', $url));
	   }
	}
	
	function admin_move($id = null) {
	   $this->layout = 'admin';
	   $this->set('current', 'catalog');
	   list($ids, $url) = $this->Url->getUrl($id);
	   $url = array_reverse($url);
	   $this->params['bread'] = $url;
      if(empty($this->data)){
         $this->Product->id = $id;
         $this->data = $this->Product->read();
         $options = $this->Category->selectTree($this->data['Product']['category_id'], True);
         $this->set('options', $options);
      } else {
         if($this->Product->save($this->data)) {
   	      $this->Session->setFlash('Product Moved');
   	      $this->redirect('/admin/categories/show/' . implode('/', $url));
         }
      }
	}
	
	function admin_search() {
	   $this->layout = 'admin';
	   $this->set('current', 'catalog');
      $products = $this->Product->stringSearch($this->params['url']['terms'], array('name', 'model'));
      $this->set('products', $products);
      $this->set('sidebar', array('admin_categories'));
	}
	
}
?>