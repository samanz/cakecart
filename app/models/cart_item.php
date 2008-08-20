<?php
class CartItem extends AppModel {
   var $name = 'CartItem';
   var $belongsTo = array('Product');
}
?>