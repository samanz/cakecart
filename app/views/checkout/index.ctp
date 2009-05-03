<h2>Checkout</h2>
<?php echo $form->create('Order', array('url' => '/checkout/index')); ?>
   <fieldset>
      <legend>Shipping Address</legend>
      <?php echo $form->input('address'); ?>
      <?php echo $form->input('address2'); ?>
      <?php echo $form->input('city'); ?>
      <?php echo $form->input('state'); ?>
      <?php echo $form->input('zip'); ?>
   </fieldset>
   <fieldset>
      <legend>Billing Address</legend>
      <?php echo $form->input('bill_address'); ?>
      <?php echo $form->input('bill_address2'); ?>
      <?php echo $form->input('bill_city'); ?>
      <?php echo $form->input('bill_state'); ?>
      <?php echo $form->input('bill_zip'); ?>
   </fieldset>
   <fieldset>
      <legend>Shipping Options</legend>
      <?php echo $form->input('shipping_method', 
         array('options' => array(
            '0' => 'UPS Ground - 5.95',
            '1' => 'USPS Ground - 3.95',
            '2' => 'Fedex Ground - 2.95'
            )
      )); ?>
   </fieldset>
   <fieldset>
      <legend>Payment Options</legend>
      <?php echo $form->input('payment_method', 
         array('options' => array(
            '0' => 'Credit Card',
            '1' => 'Paypal',
            '2' => 'Google Checkout'
            )
      )); ?>
      <div id = "method0">
         <?php echo $form->input('credit_number',
            array('size' => '50')
         ); ?>
         <?php echo $form->input('credit_cvv',
            array('size' => '10')
         ); ?>
         <?php echo $form->input('credit_month',
      array('options' => array(
            '01' => '01 - Jan',
            '02' => '02 - Feb',
            '03' => '03 - Mar',
            '04' => '04 - Apr',
            '05' => '05 - May',
            '06' => '06 - Jun',
            '07' => '07 - Jul',
            '08' => '08 - Aug',
            '09' => '09 - Sep',
            '10' => '10 - Oct',
            '11' => '11 - Nov',
            '12' => '12 - Dec'
         ))
         ); ?>
         <?php 
            $year = array();
            $cy = date('Y');
            for($y=0; $y<11; $y++) { $year[$y+$cy] = $y+$cy; }
            echo $form->input('credit_year', array('options' => $year )); 
         ?>
      </div>
   </fieldset>
<?php echo $form->end('Place Order'); ?>