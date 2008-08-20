<?php
class UspsComponent extends Object {
   var $url = 'http://testing.shippingapis.com/ShippingAPITest.dll?API=RateV3&XML=';
   var $user_id = '475SLIVE2566';
   
   function rates($origin, $dest, $cart)
   {
      $this->origin = $origin;
      $this->dest = $dest;
      $this->cart = $cart;
      $this->format();
      $this->connect();
   }
   
   function format() {
      $req = '<RateV3Request USERID="' . $this->user_id . '">';
      foreach($this->cart['CartItems'] as $key => $item):
         $req .= '<Package ID="'. ($key + 1) . 'ST">';
         $req .= '<Service>PRIORITY</Service>';
         $req .= '<ZipOrigination>' . $this->origin . '</ZipOrigination>';
         $req .= '<ZipDestination>' . $this->dest . '</ZipDestination>';
         $req .= '<Pounds>10</Pounds>';
         $req .= '<Ounces>5</Ounces>';
         $req .= '<Machinable>true</Machinable>';
         $req .= '</Package>';
      endforeach;
      $req .= '</RateV3Request>';
      $this->xml = $req;
   }
   
   function connect() {
      $url = $this->url . $this->xml;
      $ch = curl_init();
      // set URL and other appropriate options
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

      // grab URL and pass it to the browser
      $this->resp = curl_exec($ch);

      // close curl resource, and free up system resources
      curl_close($ch);
      die($url);   
   }
   
}
?>