<script type = "text/javascript" src = "<?php echo $html->url('/js/tiny_mce/tiny_mce.js'); ?>" ></script>
<script type = "text/javascript" src = "<?php echo $html->url('/js/mceinit.js'); ?>" ></script>
<h2>Adding New Product in <?php echo implode(' -> ', $this->params['bread'])?></h2>
<?php echo $form->create('Product', array('type' => 'file', 'action' => 'add/' . implode('/', $this->params['bread']), 'onsubmit' => 'move()')); ?>
<div id = "default">
<?php echo $form->hidden('id'); ?>
<?php echo $form->input('model', array('div' => 'input model')); ?>
<?php echo $form->input('name', array('size' => '90', 
                                      'div'  => 'input name'
                        )); ?>
<?php echo $form->input('brand', array('div' => 'input brand')); ?>
<?php echo $form->input('quantity', array('div' => 'input quantity')); ?>
<?php echo $form->input('sale', array('type'=>'radio', 'options' => array('0' => 'Not On Sale', '1' => 'On Sale'))); ?>
<?php echo $form->input('price', array('div' => 'input price')); ?>
<?php echo $form->input('saleprice', array('div' => 'input saleprice')); ?>
<?php echo $form->input('quantity_discounted', array('type'=>'radio', 'options' => array('1' => 'Quantity Discounted', '0' => 'Not Quantity Discounted'))); ?>
<?php echo $form->input('quantity_amount', array('div' => 'input quantity_amount')); ?>
<?php echo $form->input('quantity_discount', array('div' => 'input quantity_discount')); ?>
<?php echo $form->input('ground', array('div'=>'input ground')); ?>
<?php echo $form->input('second', array('div'=>'input second')); ?>
<?php echo $form->input('third', array('div'=>'input third')); ?>
<?php echo $form->input('pounds', array('div'=>'input pounds')); ?>
<?php echo $form->input('ounces', array('div'=>'input ounces')); ?>
<?php echo $form->input('condition', array('options' => array('0' => 'New', '1' => 'Used', '2'=>'Refurbished'))); ?>
<?php echo $form->input('featured1', array('div'=>'input featured')); ?>
<?php echo $form->input('featured2', array('div'=>'input featured')); ?>
<?php echo $form->input('featured3', array('div'=>'input featured')); ?>
<?php echo $form->input('featured4', array('div'=>'input featured')); ?>
<?php echo $form->input('featured5', array('div'=>'input featured')); ?>

<?php echo $form->input('description'); ?>
<?php echo $form->input('includes'); ?>
<?php echo $form->input('status', array('type'=>'radio', 'options' => array('0' => 'Not In Stock', '1' => 'In Stock', '2'=> 'Not Shown'))); ?>
<?php echo $form->input('featured', array('type'=>'radio', 'options' => array('0' => 'Not Featured', '1' => 'Featured'))); ?>
<?php echo $form->input('new', array('type'=>'radio', 'options' => array('0' => 'New Arrival', '1' => 'Not New Arrival'))); ?>
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