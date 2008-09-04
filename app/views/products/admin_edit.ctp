<script type = "text/javascript" src = "<?php echo $html->url('/js/tiny_mce/tiny_mce.js'); ?>" ></script>
<style>
#content .mceEditor td {
   padding:0;
} 
</style>
<script type="text/javascript">
tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	plugins : "table,save,advlink,preview,print,contextmenu",
	theme_advanced_buttons1_add_before : "save,separator",
	theme_advanced_buttons3_add_before : "tablecontrols,separator",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,

	// Example content CSS (should be your site CSS)
	content_css : "css/content.css",

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "lists/template_list.js",
	external_link_list_url : "lists/link_list.js",
	external_image_list_url : "lists/image_list.js",
	media_external_list_url : "lists/media_list.js"

});</script>
<h2>Editing <?php echo $this->data['Product']['name']; ?></h2>
<?php echo $form->create('Product', array('type' => 'file', 'action' => 'edit', 'onsubmit' => 'move()')); ?>
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