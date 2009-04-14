<?php
class OrdersController extends AppController {
   var $name = 'Orders';
   var $helpers = array('Onorder');
   var $components = array('AuthorizeNet'); 
   
   function beforeFilter() {
	   $this->setUser();
	   if(@$this->params['admin'] != 1)
	      $this->Auth->allow('*');
	}
	
   function admin_index() {
      $this->layout = 'admin';
      $this->set('current', 'orders');
      $orders = $this->Order->find('all', array('conditions' => $this->conditions()));
      $this->set('orders', $orders);
      $this->set('sidebar', array('admin_orders'));
      if(!isset($orders[0]))
         $this->render('admin_empty');
   }
   function admin_chargeCard($id) {
      $order = $this->Order->find(array('Order.id' => $id));
      debug($order);
      $billinginfo = array("fname" => $order['User']['first'],
                          "lname" => $order['User']['last'],
                          "address" => $order['Order']['bill_address'],
                          "city" => $order['Order']['bill_city'],
                          "state" => $order['Order']['bill_state'],
                          "zip" => $order['Order']['bill_zip'],
                          "country" => "USA");
  
      $shippinginfo = array("fname" => $order['User']['first'],
                          "lname" => $order['User']['last'],
                          "address" => $order['Order']['bill_address'],
                          "city" => $order['Order']['bill_city'],
                          "state" => $order['Order']['bill_state'],
                          "zip" => $order['Order']['bill_zip'],
                          "country" => "USA");
  
      $response = $this->AuthorizeNet->chargeCard(Configure::read('Authorize.login');, Configure::read('Authorize.pass');, '4111111111111111', '01', '2009', '123', false, 110, 5, 5, "Purchase of Goods", $billinginfo, "email@email.com", "555-555-5555", $shippinginfo);
   }
   function admin_invoice($id) {
      $this->layout = 'invoice';
      $this->Order->recursive = 2;
      $order = $this->Order->find(array('Order.id' => $id));
      $this->set('order', $order);
      
   }
   function admin_edit($id = null) {
      if(empty($this->data)) {
         $this->Order->id = $id;
         $this->data = $this->Order->read();
      } else {
         $this->data['Order']['credit_month'] = $this->data['Order']['credit_month']['month'];
         $this->data['Order']['credit_year'] = substr($this->data['Order']['credit_year']['year'], -2);
         if($this->Order->save($this->data)) {
            $this->Session->setFlash('Order Edited.');
            $this->redirect('/admin/orders');
         }
      }
   }
   function admin_remove($id) {
      if(!isset($_POST['sent'])) {
         $order = $this->Order->find(array('Order.id' => $id));
         $this->set('order', $order);
      } else {
         $this->Order->del($id);
         $this->Session->setFlash('Order Deleted.');
         $this->redirect('/admin/orders');
      }
   }
   function admin_show($id) {
      $this->set('current', 'orders');
      $this->Order->recursive = 2;
      $order = $this->Order->find(array('Order.id' => $id));
      $this->data = $order;
      $this->set('order', $order);
      $this->set('sidebar', array('admin_order'));
   }
   function admin_status() {
      if(!empty($this->data)) {
         if($this->Order->save($this->data)) {
            $this->redirect('/admin/orders/show/' . $this->data['Order']['id']);
         }
      }
   }
   function conditions() {
      $conditions = array();
      if(!isset($this->params['named']['status'])) $status = null;
      else $status = $this->params['named']['status'];
      if(!isset($this->params['named']['interval'])) $interval = null;
      else { 
          if($this->params['named']['interval'] == 0)
            $interval = date('Y-m-d') . ' 00:00:00';
          elseif($this->params['named']['interval'] == 1) {
             if(date("l") == "sunday")
                $inteval = date("Y-m-d"); // if today is sunday, just give today's date
             else
                $interval = date("Y-m-d", strtotime("last sunday")); // when asking on
            $interval .= ' 00:00:00';
         } else
            $interval = date('Y-m') . '-01 00:00:00';
      }
      if($status != null) $conditions[] = array('Order.status' => $status);
      if($interval != null) $conditions[] = array('Order.created >' => $interval);
      return $conditions;
   }
}
?>