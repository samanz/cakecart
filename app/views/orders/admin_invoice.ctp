<div id = "brand">
<div id = "company_details">
	<?php #echo $html->image('logobw.gif'); ?>
	<h1><?php echo Configure::read('Company.name'); ?></h1>
	<p>123 Frein St &nbsp; Suite 302  &nbsp; Palm Harbor, Fl 34567</p>
</div>
<div id = "invoice">
	<h2>Invoice</h2>
	<div>
		<p>
			<span>Date:</span> <span class = "detail"><?php 
			
			$timestamp = $order['Order']['created'];
			$time = strtotime($timestamp);
			echo date('D, F d Y', $time); ?></span>
		</p>
		<p>
			<span>Invoice #</span> <span class = "detail"><?php echo $order['Order']['id']; ?></span>
		</p>
	</div>
</div>
</div>
<div id = "bill_to">
   <h3>Billing Address</h3>
   <p><?php echo $order['User']['first'] . ' ' . $order['User']['last']; ?></p>
   <p><?php echo $order['Order']['bill_address']; ?></p>
   <?php if($order['Order']['bill_address2'] != '') echo '<p>' . $order['Order']['bill_address2'] . '</p>'; ?>
   <p><?php echo $order['Order']['bill_city'] . ', ' . $order['Order']['bill_state'] . ' ' . $order['Order']['bill_zip']; ?></p>
</div>

<div id = "ship_to">
   <h3>Shipping Address</h3>
   <p><?php echo $order['User']['first'] . ' ' . $order['User']['last']; ?></p>
   <p><?php echo $order['Order']['address']; ?></p>
   <?php if($order['Order']['address2'] != '') echo '<p>' . $order['Order']['address2'] . '</p>'; ?>
   <p><?php echo $order['Order']['city'] . ', ' . $order['Order']['state'] . ' ' . $order['Order']['zip']; ?></p>
</div>
<div>
   <table id = "items">
      <tr>
         <th>Quantity</th>
         <th>Model</th>
         <th>Item Name</th>
         <th class = "price">Price</th>
      </tr>
      <?php foreach($order['OrderItems'] as $item): ?>
      <tr>
         <td><?php echo $item['quantity']; ?></td>
         <td><?php echo $item['Product']['model']; ?></td>
         <td><?php echo $item['Product']['name']; ?></td>
         <td class = "price">$<?php echo $item['price']; ?></td>
      </tr>
      <?php endforeach; ?>
      <tr class = "info">
         <td colspan = "3">Shipping Method:</td>
         <td><?php echo ucwords($order['Order']['shipping_method']); ?></td>
      </tr>
      <tr class = "info">
         <td colspan = "3">Shipping:</td>
         <td>$<?php echo $order['Order']['shipping']; ?></td>
      </tr>
      <tr class = "info">
         <td colspan = "3">Tax:</td>
         <td>$<?php echo $order['Order']['tax']; ?></td>
      </tr>
      <tr class = "info">
         <td colspan = "3">Total:</td>
         <td>$<?php echo $onorder->total($order); ?></td>
      </tr>
   </table>
</div>
<p id = "thanks">Thank You for shopping at <?php echo Configure::read('Company.name'); ?>.</p>