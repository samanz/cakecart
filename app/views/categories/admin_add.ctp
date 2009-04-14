<script>
$(document).ready(function () {
   var parent = $("#parent").val();
   $("#CategoryName").keypress(function (e) {
      setTimeout('updateSlug()', 100);
      window.updateSlug = function() {
         var str = parent + $("#CategoryName").val();
         str = str.replace(/ /g,'_');
         $("#CategoryUrl").val(str);
      }
   });
});
</script>
<h2>Adding New Category in <?php if(empty($this->params['bread'])) { echo 'Top Level'; } else { echo implode(' &rarr; ', $this->params['bread']); } ?></h2>
<?php echo $form->create('Category', array('type' => 'file', 'action' => 'add/' . implode('/', $this->params['bread']))); ?>
<input id = "parent" type = "hidden" value = "<?php echo $this->data['Category']['url']; ?>" />
<?php echo $form->input('name', array('size' => '50')); ?>
<?php echo $form->input('url',  array('size' => '90')); ?>
<?php echo $form->input('image_url', array('type'=>'file')); ?>
<?php echo $form->end('Add'); ?>