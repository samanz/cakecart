<div id = "user_types">
   <h2>User Types</h2>
   <ul>
      <li id = "customers">
      <?php if($this->params['action'] != 'admin_index'): ?>
         <?php echo $html->link('Customers', '/admin/users/'); ?>
      <?php else: ?>
         <strong>Customers</strong>
      <?php endif; ?>
      </li>
      <li id = "admins">
      <?php if($this->params['action'] != 'admin_admins'): ?>
         <?php echo $html->link('Admins', '/admin/users/admins'); ?>
      <?php else: ?>
         <strong>Admins</strong>
      <?php endif; ?>
      </li>
   </ul>
</div>