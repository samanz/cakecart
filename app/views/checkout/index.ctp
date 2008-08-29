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
   </fieldset>
<?php echo $form->end('Place Order'); ?>