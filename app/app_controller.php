<?php
class AppController extends Controller {
   var $helpers = array('Html', 'Form', 'Url');
   
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
}
?>