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
   function isCurrent($coupon) {
      if(!isset($coupon['Coupon'])) $coupon['Coupon'] = $coupon;
      $today = strtotime("now");
      $end = strtotime($coupon['Coupon']['end']);
      $start = strtotime($coupon['Coupon']['start']);
      $current = false;
      if ($end > $today && $today > $start) $current = true;
      return $current;
   }
   
   function findAllWithCurrent() {
      $coupons = $this->find('all');
      foreach($coupons as $key => $coupon) {
         if($this->isCurrent($coupon)) 
            $coupons[$key]['Coupon']['current'] = true;
         else
            $coupons[$key]['Coupon']['current'] = false;
      }
      return $coupons;
   }
}
?>