<?php
   echo $form->create('Order', array('action'=>'edit'));
?>
<?php echo $form->hidden('id'); ?>
<fieldset id = "billing">
   <legend>Billing Address</legend>
<?php
   echo $form->input('bill_address', array('div' => 'input address', 'label' => 'Address'));
   echo $form->input('bill_address2', array('div' => 'input address', 'label'=> 'Address 2'));
   echo $form->input('bill_city', array('div' => 'input city', 'label'=> 'City'));
   echo $form->input('bill_state', array(
      'options' => Configure::read('Address.states'),
      'div' => 'input state',
      'label' => 'State'
   ));
   echo $form->input('bill_zip', array('div' => 'input zip', 'label'=> 'Zip'));
?>
</fieldset>
<fieldset id = "shipping">
   <legend>Shipping Address</legend>
<?php
   echo $form->input('address', array('div' => 'input address'));
   echo $form->input('address2', array('div' => 'input address', 'label'=> 'Address 2'));
   echo $form->input('city', array('div' => 'input city'));
   echo $form->input('state', array(
      'options' => Configure::read('Address.states'),
      'div' => 'input state'                                    
   ));
   echo $form->input('zip', array('div' => 'input zip'));
?>
</fieldset>
<fieldset id = "shipping_method">
   <legend>Shipping</legend>
<?php
   echo $form->input('shipping_method' , array('options' => array(
      '0' => 'Ground',
      '1' => 'Third Day Select',
      '2' => 'First Class'
      )));
   echo $form->input('shipping');
?>
</fieldset>

<fieldset id = "payment_method">
   <legend>Payment</legend>
<?php
   echo $form->input('payment_method', array('options' => array(
      '0' => 'Credit Card',
      '1' => 'Paypal',
      '2' => 'Google Checkout'
   )));
   echo $form->input('credit_number', array('div'=>'input credit'));
   echo $form->input('credit_month', array('div'=>'input month', 'type'=> 'date', 'dateFormat' => 'M'));
   echo $form->input('credit_year', array('div'=>'input year', 'type'=> 'date', 'dateFormat' => 'Y', 'minYear' => date('Y'), 'maxYear'=> date('Y')+10));
   echo $form->input('credit_cvv', array('div'=>'input cvv'));
?>
</fieldset>
<?php
   echo $form->end('Save');
?>