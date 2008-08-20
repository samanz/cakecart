<?php
class CartfComponent extends Object {
   var $components = array('Session');
   
   function start() {
      $cart = ClassRegistry::init('Cart');
      $cart->recursive = 2;
		if($this->Session->check('cart.id')) {
		   $current = $cart->find( array('Cart.session' => $this->Session->read('cart.id')) );
		   if(isset($current['Cart']))
		      return $current;
		}
		$cart->create();
		$data = array();
		$data['Cart']['session'] = $this->Session->read('Config.rand');
		$this->Session->write('cart.id', $this->Session->read('Config.rand'));
		$cart->save($data);
		$id = $cart->getLastInsertId();
		return $cart->find( array('Cart.id' => $id) );
   }
   
   function get() {
      $cart = ClassRegistry::init('Cart');
		if($this->Session->check('cart.id')) {
		   $cart->recursive = 2;
		   $current = $cart->find( array('Cart.session' => $this->Session->read('cart.id')) );
		   if(isset($current['Cart']))
		      return $current;
		}
      return null;
   }
   
   function delete() {
      $current = $this->get();
      $cart = ClassRegistry::init('Cart');
      $cart->del($current['Cart']['id']);
      $this->Session->del('cart.id');
   }
     
}
?>