<?php
class CheckoutController extends AppController {
   var $name = 'Checkout';
   var $uses = array('Order', 'OrderItem');
   var $layout = 'shop';
   var $components = array('Session', 'Cartf', 'Shipping');
   
   function beforeFilter() {
      $this->setUser();
      $this->Auth->authError = 'Please Login to Checkout';
   }
   
   function index() {
      $cart = $this->Cartf->get();
      if(!isset($cart['CartItems'][0])) {
         $this->Session->setFlash('You cannot check out because there are no items in your shopping cart.');
         $this->redirect('/');
      }
      if(!empty($this->data)) {
         $this->data['Order']['user_id'] = $this->Auth->user('id');
         if($this->Order->save($this->data)) {
				$order_id = $this->Order->getLastInsertId();
            $this->_populate($this->Order->getLastInsertId(), $cart);
         	$this->Cartf->delete();
         	$this->redirect('/checkout/complete/' . $order_id);
         }
      }
   }
   
   function shipping() {
      $this->layout = 'AJAX';
      $cart = $this->Cartf->get();
      $this->Shipping->get('usps', '10022', '20008', $cart);
   }
   
   function _populate($order_id, $cart) {
		foreach($cart['CartItems'] as $item) {
			$data['OrderItem']['product_id'] = $item['product_id'];
			$data['OrderItem']['price'] = $item['price'];
			$data['OrderItem']['quantity'] = $item['quantity'];
			$data['OrderItem']['order_id'] = $order_id;
			if(!$this->OrderItem->save($data)) {
				die('Could not write data');
			}
			$this->OrderItem->id = false;
		}
	}
	function complete($id) {
	   $this->Order->recursive = 2;
	   $order = $this->Order->find(array('Order.id' => $id));
	   if($order['Order']['user_id'] == $this->Auth->user('id')) {
	      $this->set('total', $this->orderTotal($order));
	      $this->set('order', $order);
	   } else {
	      $this->render('simple');
	   }
	}
}
?>