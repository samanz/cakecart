<?php
class Coupon extends AppModel {
   var $name = 'Coupon';
   var $hasAndBelongsToMany = array('Category' =>
                                 array('className'    => 'Category',
                                       'joinTable'    => 'coupons_categories',
                                       'foreignKey'   => 'coupon_id',
                                       'associationForeignKey'=> 'category_id',
                                 )
                              );
}
?>