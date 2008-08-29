<script type="text/javascript" charset="utf-8">
$(function()
{
	$('.date-pick').datePicker()
	$('#CouponStart').bind(
		'dpClosed',
		function(e, selectedDates)
		{
			var d = selectedDates[0];
			if (d) {
				d = new Date(d);
				$('#CouponEnd').dpSetStartDate(d.addDays(1).asString());
			}
		}
	);
	$('#CouponEnd').bind(
		'dpClosed',
		function(e, selectedDates)
		{
			var d = selectedDates[0];
			if (d) {
				d = new Date(d);
				$('#CouponStart').dpSetEndDate(d.addDays(-1).asString());
			}
		}
	);
});
</script>
<?php
function fill_array($start, $n, $skip = 1, $lead = True) {
   $out = array();
   for($i = $start; $i < $n; $i += $skip) {
      $id = $i;
      if( strlen($id) == 1 and $lead ) {
         $id = '0' . $id;
      }
      $out[$i] = $id;
   }
   return $out;
}
function c_select($name, $options, $current) {
   $name = explode('/', $name);
   $name = '[' . $name[0] . '][' . $name[1] . ']';
   $out = '<select name = "data' . $name . '">';
   foreach($options as $key => $value):
      $selected = '';
      if($current == $value) $selected = ' selected = "selected" ';
      $out .= '   <option value = "' . $key . '"' . $selected . '>';
      $out .= '      ' . $value;
      $out .= '   </option>';
   endforeach;
   $out .= '</select>';
   return $out;
}
function get_current($datetime) {
   $date = strtotime($datetime);
   $date_str = date('d/m/Y', $date);
   $c_hour = date('h', $date);
   $c_min = date('i', $date);
   $c_mer = date('a', $date);
   return array($date_str, $c_hour, $c_min, $c_mer);
}
?>
<?php echo $form->create('Coupon', array('action'=>'edit')); ?>
   <?php echo $form->hidden('id'); ?>
   <?php echo $form->input('code'); ?>
   <?php echo $form->input('description'); ?>
   <?php echo $form->input('percent'); ?>
   <p class = "categories">
      <span>Categories:</span>
         <?php foreach($categories as $cat): ?>
            <?php 
            $selected = False;
            foreach($this->data['Category'] as $sel): 
               if($sel['id'] == $cat['Category']['id']) $selected = True;
            endforeach;
            ?>
            <label for = "category<?php echo $cat['Category']['id']; ?>">
               <input name = "data[Category][Category][]"  id = "category<?php echo $cat['Category']['id']; ?>" type = "checkbox" value = "<?php echo $cat['Category']['id']; ?>"
               <?php if($selected) echo ' checked = "checked"'; ?> ><?php echo $cat['Category']['name']; ?>
            </label>
            <input type = "hidden" name = "data[Category][Category][]" value = "0">
         <?php endforeach; ?>
   <?php echo $form->input('freeship', array('type' => 'radio', 'options' => array(
      '1' => 'Yes', 
      '0' => 'No')
   )); ?>
      <?php echo $form->input('over'); ?>
   <div style = "clear:both"></div>
   <p>
      <label for = "CouponStart">Start:</label>
      <?php 
      list($date_str, $c_hour, $c_min, $c_mer) = get_current($this->data['Coupon']['start']);
      ?>
      <input type = "text" value = "<?php echo $date_str; ?>" name = "data[Coupon][start_date]" id = "CouponStart" class = "date-pick" />
   </p>
   <p>
      <label for = "CouponEnd">End:</label>
      <?php 
      list($date_str, $c_hour, $c_min, $c_mer) = get_current($this->data['Coupon']['end']);
      ?>
      <input type = "text" value = "<?php echo $date_str; ?>" name = "data[Coupon][end_date]" id = "CouponEnd" class = "date-pick" />
   </p>
   <div style = "clear:both">&nbsp;</div>
   <?php echo $form->input('uses'); ?>
<?php echo $form->end('Save'); ?>