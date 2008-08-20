<?php
class OrderItem extends AppModel {
   var $name = 'OrderItem';
   var $belongsTo = array('Product');
}
?>