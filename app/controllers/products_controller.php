<?php
class ProductsController extends AppController {
	var $name = 'Products';
	var $layout = 'shop';
	var $components = array('Url', 'Session', 'Imagef');
	var $helpers = array('Html', 'Url', 'Thumbnail');   
	var $uses = array('Product', 'Category', 'Image', 'Brand', 'Option', 'OptionDetail');
	
	function beforeFilter() {
	   $this->setUser();
	   if(@$this->params['admin'] != 1)
	      $this->Auth->allow('*');
	}
	
	function index() {
		$this->set('feat', $this->Product->find('all', array('conditions' => array('featured' => '1'))));
		$this->set('new', $this->Product->find('all', array('conditions' => array('new' => '1'))));
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
	   $this->set('sidebar', array('admin_product'));
		list($id,$ids, $urls) = $this->Url->parents($this->params['pass']);
		$this->params['bread'] = explode('/', $urls);
	   if(!empty($this->data)) {
         if($this->Imagef->check($this->data['Product']['image_url'])) {
	         $this->data['Product']['image'] = $this->Imagef->save( $this->data['Product']['image_url'] );
	      }
	      $this->data['Product']['category_id'] = $id;
	      $this->data['Product']['brand_id'] = $this->_brand($this->data['Product']);
	      if($this->Product->save($this->data)) {
	         $product_id = $this->Product->getLastInsertId();
	         $this->_addImages($product_id, $this->data);
	         $this->Session->setFlash('Product Added');
	         $this->redirect('/admin/categories/show/' . $urls);
	      }
	      
	   }
	}
	
	function _brand($prod) {
		if($prod['brand'] != '') {
			$brand = $this->Brand->find("Brand.name = '" . $prod['brand'] . "'");
			
			if( isset($brand['Brand']['id']) ) {
				return $brand['Brand']['id'];
			} else {
				$this->data['Brand']['name'] = $prod['brand'];
				if($this->Brand->save($this->data)){
					return $this->Brand->getLastInsertId();
				} else {
					return 0;
				}
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
	   if(isset($form['delimage'])){
	      foreach($form['delimage'] as $image) {
			   if($image['del'] == 1)
				   $this->Image->del($image['id']);
		   }
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
	      $this->data['Product']['brand_id'] = $this->_brand($this->data['Product']);
	      if(!empty($this->data['Option'])) 
            $this->data['Option']['Option'] = $this->_addOptions($this->data['Option']);
         //debug($this->data);
	      if($this->Product->save($this->data)) {
	         $product_id = $this->data['Product']['id'];
	         if(!empty($this->data['removeOption']))
	            $this->_removeOptions($product_id, $this->data['removeOption']);
	         $this->_removeImages($this->params['form']);
	         $this->_addImages($product_id, $this->data);
	         $this->Session->setFlash('Product Edited');
	         $this->redirect('/admin/categories/show/' . implode('/', $url));
	      }
	   }
	}
	
	function _removeOptions($product_id, $options) {
	   foreach($options as $option) {
	      $this->Product->ProductsOption->deleteAll(array('product_id' =>
         $product_id, 'option_id' => $option), false);
	   }
	}
	
	function _addOptions($options) {
	   $option_ids = array();
	   foreach($options as $option) {
	      $data['Option']['name'] = $option['name'];
	      $this->Option->save($data);
	      $option_id = $this->Option->getLastInsertId();
	      foreach($option['OptionDetail'] as $detail) {
	         $data['OptionDetail']['name'] = $detail['name'];
 			   $data['OptionDetail']['price'] = $detail['price'];
 			   $data['OptionDetail']['weight'] = $detail['weight'];
 			   $data['OptionDetail']['option_id'] = $option_id;
 			   if(!$this->OptionDetail->save($data)) {
 				   die('Could not write data');
 			   }
 			   $this->OptionDetail->id = false;
	      } 
	      $option_ids[] = $option_id;
	      $this->Option->id = false;
	   }
	   return $option_ids;
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