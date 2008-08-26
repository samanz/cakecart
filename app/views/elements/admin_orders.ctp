<div id = "side_orders">
   <h2>Show Orders</h2>
   <ul>
      <?php if(@$this->params['named']['status'] == 0 && isset($this->params['named']['status'])): ?>
         <li><strong>Pending</strong></li>
      <?php else: ?>
         <li><?php echo $html->link('Pending', '/admin/orders/index/status:0'); ?></li>
      <?php endif; ?>
      <?php if(@$this->params['named']['status'] == 1): ?>
         <li><strong>Processing</strong></li>
      <?php else: ?>
         <li><?php echo $html->link('Processing', '/admin/orders/index/status:1'); ?></li>
      <?php endif; ?>
      <?php if(@$this->params['named']['status'] == 2): ?>
         <li><strong>Shipped</strong></li>
      <?php else: ?>
         <li><?php echo $html->link('Shipped', '/admin/orders/index/status:2'); ?></li>
      <?php endif; ?>
      <?php if(@$this->params['named']['status'] == 3): ?>
         <li><strong>Delivered</strong></li>
      <?php else: ?>
         <li><?php echo $html->link('Delivered', '/admin/orders/index/status:3'); ?></li>
      <?php endif;?>
      <?php if(!isset($this->params['named']['status'])): ?>
         <li><strong>All</strong></li>
      <?php else: ?>
         <li><?php echo $html->link('All', '/admin/orders/'); ?></li>
      <?php endif; ?>
   </ul>
</div>