<?php
class Order extends AppModel {
   var $name = 'Order';
   var $hasMany = array('OrderItems' =>
      array('className' => 'OrderItem',
            'dependent' => true
      )
   );   
}

?>