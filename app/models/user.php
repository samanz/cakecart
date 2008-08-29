<?php
class User extends AppModel {
   var $name = 'User';
   var $hasMany = array('Orders'=> array('className' => 'Order'));
   function lastAdmin() {
      $count = $this->find('count', array('conditions' => array('User.admin' => '1')));
      return $count == 1;
   }
}
?>