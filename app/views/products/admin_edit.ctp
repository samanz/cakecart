<script type = "text/javascript" src = "<?php echo $html->url('/js/tiny_mce/tiny_mce.js'); ?>" ></script>
<script type = "text/javascript" src = "<?php echo $html->url('/js/mceinit.js'); ?>" ></script>
 <?php echo $form->create('Product', array('type' => 'file', 'action' => 'edit', 'onsubmit' => 'move()')); ?>
<div id = "default">
<?php echo $form->hidden('id'); ?>
<fieldset id = "details">
   <legend>Details</legend>
   <?php echo $form->input('brand', array('div' => 'input brand')); ?>
   
   <?php echo $form->input('model', array('div' => 'input model')); ?>
   <?php echo $form->input('name', array('size' => '90', 
                                      'div'  => 'input name'
                        )); ?>
</fieldset>
<fieldset id = "pricing">
   <legend>Pricing</legend>
<?php echo $form->input('quantity', array('div' => 'input quantity')); ?>
<?php echo $form->input('sale', array('type'=>'radio', 'options' => array('0' => 'Not On Sale', '1' => 'On Sale'))); ?>
<?php echo $form->input('price', array('div' => 'input price')); ?>
<?php echo $form->input('saleprice', array('div' => 'input saleprice')); ?>
<?php echo $form->input('quantity_discounted', array('type'=>'radio', 'options' => array('1' => 'Quantity Discounted', '0' => 'Not Quantity Discounted'))); ?>
<?php echo $form->input('quantity_amount', array('div' => 'input quantity_amount')); ?>
<?php echo $form->input('quantity_discount', array('div' => 'input quantity_discount')); ?>
</fieldset>
<fieldset id = "shipping_details">
   <legend>Shipping Details</legend>
<?php echo $form->input('ground', array('div'=>'input ground')); ?>
<?php echo $form->input('second', array('div'=>'input second')); ?>
<?php echo $form->input('third', array('div'=>'input third')); ?>

<?php echo $form->input('pounds', array('div'=>'input pounds')); ?>
<?php echo $form->input('ounces', array('div'=>'input ounces')); ?>
</fieldset>
<fieldset id = "description">
   <legend>Product Description</legend>
<?php echo $form->input('condition', array('options' => array('0' => 'New', '1' => 'Used', '2'=>'Refurbished'))); ?>
<?php echo $form->input('featured1', array('div'=>'input featured')); ?>
<?php echo $form->input('featured2', array('div'=>'input featured')); ?>
<?php echo $form->input('featured3', array('div'=>'input featured')); ?>
<?php echo $form->input('featured4', array('div'=>'input featured')); ?>
<?php echo $form->input('featured5', array('div'=>'input featured')); ?>

<?php echo $form->input('description'); ?>
<?php echo $form->input('includes'); ?>
</legend>
<fieldset id = "status">
   <legend>Status</legend>
<?php echo $form->input('status', array('type'=>'radio', 'options' => array('0' => 'Not In Stock', '1' => 'In Stock', '2'=> 'Not Shown'))); ?>
<?php echo $form->input('featured', array('type'=>'radio', 'options' => array('0' => 'Not Featured', '1' => 'Featured'))); ?>
<?php echo $form->input('new', array('type'=>'radio', 'options' => array('0' => 'Not New Arrival', '1' => 'New Arrival'))); ?>
</fieldset>
</div>
	<div id = "images">
	   <fieldset id = "mainimage">
	      <legend>Main Image</legend>
	      <?php echo $url->prods_image($this->data['Product']); ?>
	      <?php echo $form->input('image_url', array('type'=>'file')); ?>
	   </fieldset>
	   <fieldset id = "additional">
	      <legend>Additional Images</legend>
	      <?php if(isset($this->data['Images'][0]['id'])):
	         $length = sizeof($this->data['Images']) - 1;
	         foreach($this->data['Images'] as $key => $image):
            ?>
         <fieldset>
            <legend>Image <?php echo ($key+1); ?></legend>
            <p>
               <input type = "hidden" name = "delimage[<?php echo $key; ?>][id]; ?>" value = "<?php echo $image['id']; ?>" />
               <img src = "<?php echo $html->url('/img/products/' . $image['image']); ?>" alt = ""  height = "100" />   </p>
            <p>
               <label for = "delete<?php echo $key; ?>">Delete?</label>
               <input type = "hidden" name = "delimage[<?php echo $key; ?>][del]" value = "0" />
               <input type = "checkbox" name = "delimage[<?php echo $key; ?>][del]" value = "1"  id = "delete<?php echo $key; ?>"/>
   	      </p>
         </fieldset>	
	      <?php endforeach; 
	      endif; ?>
	   </fieldset>
	<h2 id = "maddition">Additional Images</h2>
</div>
	<div id = "options">
	<h2>Options</h2>
   <?php foreach($this->data['Option'] as $key => $option): ?>
         <fieldset>
            <label for = "remove<?php echo $option['id']; ?>">Remove?</label>
            <input type = "checkbox" value = "<?php echo $option['id']; ?>" name = "data[removeOption][]" />
         </fieldset>
      </form>
      <div class = "optiondetails">
      <h3><?php echo $option['name']; ?></h3>
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
   <h2 id = "addOptions">Add Option</h2>
   </div>
<?php echo $form->end('Save'); ?>
<script type="text/javascript" charset="utf-8">
function addoption(num) {
   $("#addoptiondetails" + num).manyform({
    message : "Add Option Detail",
    attrib : 'OptionDetail' + num,
    name : 'optiondetail' + num,
    max : 4,
    parentID: num,
    form : '<div class = "input option"><label for = "optiondetailname*num*">Name:<\/label><input type = "input" name = "data[Option][*parent*][OptionDetail][*num*][name]" id = "optiondetailname*num*" class = "required" /></div><div class = "input option"><label for = "optiondetailprice*num*">Price:<\/label><input type = "input" name = "data[Option][*parent*][OptionDetail][*num*][price]" id = "optiondetailprice*num*" class = "required" value = "0.00" /></div><div class = "input option"><label for = "optiondetailweight*num*">Weight:<\/label><input type = "input" name = "data[Option][*parent*][OptionDetail][*num*][weight]" id = "optionweight*num*" class = "required" value = "0" /></div>'
   });
}
   $("#addOptions").manyform({
    message : "Add Additional Options",
    attrib : 'Option',
    name : 'option',
    max : 4,
    onadd: function(num) { addoption(num); },
    form : '<div class = "input file"><label for = "option*num*">Option #*num* Name:<\/label><input type = "input" name = "data[Option][*num*][name]" id = "option*num*" class = "required" /></div><h2 id = "addoptiondetails*num*">Add Option Details</h2>'
   });
</script>
<script type="text/javascript" charset="utf-8">
   $("#maddition").manyform({
    message : "Add Additional Images",
    attrib : 'Image',
    name : 'image',
    max : 4,
    form : '<div class = "input file"><label for = "image*num*">Additional Image #*num*:<\/label><input type = "file" name = "data[Image][*num*]" id = "image*num*" class = "required" /></div>'
   });
</script>