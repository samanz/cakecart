<?php
class Order extends AppModel {
   var $name = 'Order';
   var $order = 'Order.created DESC';
   var $hasMany = array('OrderItems' =>
      array('className' => 'OrderItem',
            'dependent' => true
      )
   );
   var $belongsTo = array('User');
}

?>