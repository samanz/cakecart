<?php
class ShippingComponent extends Object {
   var $components = array('Usps');
   
   function get($method, $origin, $dest, $cart)
   {
      if($method == 'usps'):
         $this->Usps->rates($origin, $dest, $cart);
      endif;
   }
   
}
?>