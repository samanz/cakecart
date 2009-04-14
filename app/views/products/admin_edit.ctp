<script type = "text/javascript" src = "<?php echo $html->url('/js/tiny_mce/tiny_mce.js'); ?>" ></script>
<script type = "text/javascript" src = "<?php echo $html->url('/js/mceinit.js'); ?>" ></script>

<h2>Editing <?php echo $this->data['Product']['name']; ?></h2>
<?php echo $form->create('Product', array('type' => 'file', 'action' => 'edit', 'onsubmit' => 'move()')); ?>
<div id = "default">
<?php echo $form->hidden('id'); ?>
<?php echo $form->input('model', array('div' => 'input model')); ?>
<?php echo $form->input('name', array('size' => '90', 
                                      'div'  => 'input name'
                        )); ?>
<?php echo $form->input('price', array('div' => 'input price')); ?>
<?php echo $form->input('pounds', array('div'=>'input pounds')); ?>
<?php echo $form->input('ounces', array('div'=>'input ounces')); ?>
<?php echo $form->input('description'); ?>
<?php echo $form->input('status', array('type'=>'radio', 'options' => array('0' => 'Not In Stock', '1' => 'In Stock', '2'=> 'Not Shown'))); ?>
<?php echo $form->input('image_url', array('type'=>'file')); ?>
</div>
	<div id = "images">
	<h2>Additional Images</h2>
	<?php if(isset($this->data['Images'][0]['id'])):
	         $length = sizeof($this->data['Images']) - 1;
	         foreach($this->data['Images'] as $key => $image):
?>
   <fieldset>
      <legend>Additional Image <?php echo ($key+1); ?></legend>
      <p>
         <input type = "hidden" name = "delimage[<?php echo $key; ?>][id]; ?>" value = "<?php echo $image['id']; ?>" />
         <label>Current Image:</label>
         <img src = "<?php echo $html->url('/img/products/' . $image['image']); ?>" alt = ""  height = "100" />   </p>
      <p>
         <label for = "delete<?php echo $key; ?>">Delete?</label>
         <input type = "hidden" name = "delimage[<?php echo $key; ?>][del]" value = "0" />
         <input type = "checkbox" name = "delimage[<?php echo $key; ?>][del]" value = "1"  id = "delete<?php echo $key; ?>"/>
   	</p>
   </fieldset>	
	<?php    endforeach;
	      endif; ?>
	<h2 id = "addditional">Additional Images</h2>
</div>
	<div id = "options">
	<h2>Options</h2>
   <?php foreach($this->data['Options'] as $key => $option): ?>
         <fieldset>
            <label for = "remove<?php echo $option['id']; ?>">Remove?</label>
            <input type = "hidden" value = "0" name = "removeOption[<?php echo $option['id']; ?>][del]" />
            <input type = "checkbox" value = "1" name = "removeOption[<?php echo $option['id']; ?>][del]" />
         </fieldset>
      </form>
      <div class = "optiondetails">
      <h3><?php echo $option['name']; ?> - <?php echo $option['identifier']; ?></h3>
         <table>
            <tr>
               <th>Name</th>
               <th>Price</th>
               <th>Weight</th>
            </tr>
            <?php foreach($option['OptionDetails'] as $detail): ?>
            <tr>
               <td><?php echo $detail['name']; ?></td>
               <td>$<?php echo number_format($detail['price'],2); ?></td>
               <td><?php echo $detail['weight']; ?></td>
            </tr>
            <?php endforeach; ?>
         </table>
      </div>
   <?php endforeach; ?>
   </div>
<?php echo $form->end('Save'); ?>
<script type="text/javascript" charset="utf-8">
   $("#addditional").manyform({
    message : "Add Additional Images",
    attrib : 'Image',
    name : 'image',
    max : 4,
    form : '<div class = "input file"><label for = "image*num*">Additional Image #*num*:<\/label><input type = "file" name = "data[Image][*num*]" id = "image*num*" class = "required" /></div>'
   });
</script>