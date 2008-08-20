<?php
class CartsController extends AppController 
{
   var $name = 'Carts';
   var $layout = 'shop';
   var $helpers = array('Html', 'Url');
   var $components = array('Url', 'Session', 'Cartf');
   
   function index()
   {
      $cart = $this->Cartf->get();
      if( !isset($cart['Cart']) || !isset($cart['CartItems'][0])) {
         $this->render('empty');
      }
      $this->set('cart', $cart);
      $this->set('total', $this->_total($cart));
   }
   
   function _total($cart) {
      $total = 0;
      if(!isset($cart['CartItems'])) return 0;
      foreach($cart['CartItems'] as $item)
         $total += $item['price'] * $item['quantity'];
      return $total;
   }
   
   function getCart() {
      $cart = $this->Cartf->get();
      $total = $this->_total($cart);
      if(isset($this->params['requested']))
         return array($cart, $total);
      else {
         $this->set('cart', $cart);
         $this->set('total', $this->_total($cart));
         $this->render('index');
      }
   }
   
}
?>