<h2>Administrators</h2>
<table>
   <tr>
      <th>Id</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>View</th>
      <th>Edit</th>
      <th>Delete</th>
   </tr>
   <?php $count = 0; ?>
   <?php foreach($users as $user): ?>
   <tr <?php if($count % 2 == 1) echo ' class = "alt" '; ?>>
      <td><?php echo $user['User']['id']; ?></td>
      <td><?php echo $user['User']['first']; ?></td>
      <td><?php echo $user['User']['last']; ?></td>
      <td><?php echo $user['User']['email']; ?></td>
      <td class = "usrView"><?php echo $html->link('View', '/admin/users/show/' . $user['User']['id']); ?></td>
      <td class = "usrEdit"><?php echo $html->link('Edit', '/admin/users/edit/' . $user['User']['id']); ?></td>
        <td class = "usrDelete"><?php echo $html->link('Delete', '/admin/users/remove/' . $user['User']['id']); ?></td>
        <?php $count++ ?>
   </tr>
   <?php endforeach; ?>
</table><?php echo $html->link('New Administrator', '/admin/users/add_admin', array('class' => 'button newUser')); ?>