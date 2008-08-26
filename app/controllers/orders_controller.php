<?php
class OrdersController extends AppController {
   var $name = 'Orders';
   var $helpers = array('Onorder');
   function admin_index() {
      if(!isset($this->params['named']['status'])) $status = null;
      else $status = $this->params['named']['status'];
      $this->layout = 'admin';
      $this->set('current', 'orders');
      $conditions = array();
      if($status != null) $conditions = array('Order.status' => $status);
      $orders = $this->Order->find('all', array('conditions' => $conditions));
      $this->set('orders', $orders);
      $this->set('sidebar', array('admin_orders'));
   }
   function admin_show($id) {
      $this->layout = 'admin';
      $this->set('current', 'orders');
      $this->Order->recursive = 2;
      $order = $this->Order->find(array('Order.id' => $id));
      $this->set('order', $order);
   } 
}
?>