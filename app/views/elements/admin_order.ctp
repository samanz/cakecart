<div>
   <h3></h3>
   <h3><?php echo $html->link('Print Invoice', '/admin/orders/invoice/' . $order['Order']['id'], array('class' => 'button printInvoice', 'target' => '_blank')); ?></h3>
<h3><?php echo $html->link('Edit Order', '/admin/orders/edit/' . $order['Order']['id'], array('class' => 'button editOrder')); ?></h3>
<?php 
   echo $form->create('Order', array('action' => 'status'));
   echo $form->hidden('id');
   echo $form->input('status', array('options' => array(
      '0' => 'Pending',
      '1' => 'Processing',
      '2' => 'Shipped',
      '3' => 'Delivered'
      )));
   echo $form->end('Update');
?></div>