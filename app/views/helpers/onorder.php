<?php
class OnorderHelper extends AppHelper {
   var $helpers = array('Html');
   function total($order) {
      if(!isset($order['Order'])) $order['Order'] = $order;
      $total = 0.0;
      foreach($order['OrderItems'] as $item) {
        $total += $item['price'];
      }
      $total += $order['Order']['shipping'] + $order['Order']['tax'];
      return number_format($total,2);
   }
   function status($order) {
      if($order['Order']['status'] == 0) return 'Pending';
      if($order['Order']['status'] == 1) return 'Processing';
      if($order['Order']['status'] == 2) return 'Shipped';
      if($order['Order']['status'] == 3) return 'Delivered';
   }
   function format($price) { echo '$' . number_format($price,'2'); }
}
?>