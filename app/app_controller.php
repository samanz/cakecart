<?php
class AppController extends Controller {
   var $helpers = array('Html', 'Form', 'Url');
   var $components = array('Auth');
   
   function beforeFilter() {
      $this->setUser();
   }
   function setUser() {
      if($this->Auth->user() != null) {
	      $this->params['user'] = $this->Auth->user();
	   } else {
	      $this->params['user'] = false;
	   }
      if(@$this->params['admin'] != 1) {
	      $this->layout = 'shop';
	      $this->Auth->logoutRedirect = '/';
	   } else {
	      $this->layout = 'admin';
	      if($this->Auth->user('admin') != '1') 
	         $this->Auth->logout();
	      $this->Auth->logoutRedirect = '/admin/users/login';
	      $this->Auth->loginRedirect = '/admin/categories';
	   }
   }
   
   function cartTotal($cart) {
      $total = 0;
      if(!isset($cart['CartItems'])) return 0;
      foreach($cart['CartItems'] as $item)
         $total += $item['price'] * $item['quantity'];
      return $total;      
   }
   
   function orderTotal($order) {
      $total = 0;
      if(!isset($order['OrderItems'])) return 0;
      foreach($order['OrderItems'] as $item)
         $total += $item['price'] * $item['quantity'];
      $total += $order['Order']['tax'] + $order['Order']['shipping'];
      return $total;      
   }
   
   function d($data) {
      die('<pre>' . print_r($data, true) . '</pre>'); 
   }
   
   function ep($data) {
      echo('<pre>' . print_r($data, true) . '</pre>'); 
   }
}
?>