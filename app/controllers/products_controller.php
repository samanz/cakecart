<?php
class ProductsController extends AppController {
	var $name = 'Products';
	var $layout = 'shop';
	var $components = array('Url', 'Session', 'Image');
	var $helpers = array('Html', 'Url');
	
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
	function admin_edit($id = null) {
	   $this->layout = 'admin';
	   $this->set('current', 'catalog');
	   list($ids, $url) = $this->Url->getUrl($id);
	   $url = array_reverse($url);
	   if(empty($this->data)) {
	      $this->Product->id = $id;
	      $this->data = $this->Product->read();
	   } else {
	      #$this->debugger($this->data);
	      if($this->Image->check($this->data['Product']['image_url'])) {
	         $this->data['Product']['image'] = $this->Image->save($this->data['Product']['image_url']);	
	      }		
	      if($this->Product->save($this->data)) {
	         $this->Session->setFlash('Product Edited');
	         $this->redirect('/admin/categories/show/' . implode('/', $url));
	      }
	   }
	}
}
?>