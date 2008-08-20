<?php
class Cart extends AppModel {
   var $name = 'Cart';
   var $hasMany = array('CartItems' =>
      array('className' => 'CartItem',
            'dependent' => true
      )
   );   
}

?>