<?php
class CartItemsController extends AppController {
   var $name = 'CartItems';
   var $uses = array('CartItem', 'Product');
   var $components = array('Url', 'Session', 'Cartf');
   var $layout = 'shop';
   
	function beforeFilter() {
	   $this->setUser();
	   if(@$this->params['admin'] != 1)
	      $this->Auth->allow('*');
	}
	
   function add() {
      $cart = $this->Cartf->start();
      $product_id = $this->data['CartItem']['product_id'];
      $id = $this->_check($cart, $product_id);
      if($id > 0)
         $this->data['CartItem']['id'] = $id;
      $product = $this->Product->find(array('Product.id' => $product_id));
      $this->data['CartItem']['quantity'] += $this->_quantity($cart, $product_id);
      $this->data['CartItem']['price'] = $product['Product']['price'];
      $this->data['CartItem']['cart_id'] = $cart['Cart']['id'];
      if($this->CartItem->save($this->data))
         $this->redirect('/carts');
   }
   
   function remove() {
      $this->CartItem->del($this->data['CartItem']['id']);
      $this->redirect('/carts');
   } 
   
   function change() {
      if($this->data['CartItem']['quantity'] < 1) {
         $this->CartItem->del($this->data['CartItem']['id']);
         $this->redirect('/carts');
      } else {
         if($this->CartItem->save($this->data))
            $this->redirect('/carts');
      }
   }
   
   function _check($cart, $product_id) {
      $id = -1;
      foreach($cart['CartItems'] as $item) {
         if($item['product_id'] == $product_id)
            $id = $item['id'];
      }
      return $id;
   }
   
   function _quantity($cart, $product_id) {
      $quantity = 0;
      foreach($cart['CartItems'] as $item) {
         if($item['product_id'] == $product_id)
            $quantity = $item['quantity'];
      }
      return $quantity;
   }   
}
?>