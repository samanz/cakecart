<?php 
$sts = '';
$inv = '';
if(isset($this->params['named']['status']))
   $sts = '/status:' . $this->params['named']['status'];
if(isset($this->params['named']['interval']))
   $inv = '/interval:' . $this->params['named']['interval'];
   
;?>
<div id = "side_orders">
   <h2>Show Orders</h2>
   <ul>
      <?php if(@$this->params['named']['status'] == 0 && isset($this->params['named']['status'])): ?>
         <li><strong>Pending</strong></li>
      <?php else: ?>
         <li><?php echo $html->link('Pending', '/admin/orders/index/status:0'. $inv); ?></li>
      <?php endif; ?>
      <?php if(@$this->params['named']['status'] == 1): ?>
         <li><strong>Processing</strong></li>
      <?php else: ?>
         <li><?php echo $html->link('Processing', '/admin/orders/index/status:1' . $inv); ?></li>
      <?php endif; ?>
      <?php if(@$this->params['named']['status'] == 2): ?>
         <li><strong>Shipped</strong></li>
      <?php else: ?>
         <li><?php echo $html->link('Shipped', '/admin/orders/index/status:2' . $inv); ?></li>
      <?php endif; ?>
      <?php if(@$this->params['named']['status'] == 3): ?>
         <li><strong>Delivered</strong></li>
      <?php else: ?>
         <li><?php echo $html->link('Delivered', '/admin/orders/index/status:3' . $inv); ?></li>
      <?php endif;?>
      <?php if(!isset($this->params['named']['status'])): ?>
         <li><strong>All</strong></li>
      <?php else: ?>
         <li><?php echo $html->link('All', '/admin/orders/index' . $inv); ?></li>
      <?php endif; ?>
   </ul>
</div>
<div id = "by_days">
   <h2>Time Interval</h2>
   <ul>
      <li id = "today">
      <?php if(@$this->params['named']['interval'] != 0 || !isset($this->params['named']['interval'])): ?>
         <?php echo $html->link('Today', '/admin/orders/index/interval:0' . $sts); ?>
      <?php else: ?>
         <strong>Today</strong>
      <?php endif; ?>
      </li>
      <li id = "week">
      <?php if(@$this->params['named']['interval'] != 1): ?>
         <?php echo $html->link('This Week', '/admin/orders/index/interval:1' . $sts); ?>
      <?php else: ?>
         <strong>This Week</strong>
      <?php endif; ?>
      </li>
      <li>
      <?php if(@$this->params['named']['interval'] != 2): ?>
         <?php echo $html->link('This Month', '/admin/orders/index/interval:2' . $sts); ?>
      <?php else: ?>
         <strong>This Month</strong>
      <?php endif; ?>
      <?php if(!isset($this->params['named']['interval'])): ?>
         <li><strong>All Time</strong></li>
      <?php else: ?>
         <li><?php echo $html->link('All Time', '/admin/orders/index' . $sts); ?></li>
      <?php endif; ?>
      </li>
   </ul>
</div>