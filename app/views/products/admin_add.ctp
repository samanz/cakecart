<script type="text/javascript">
//<![CDATA[
	function move() {
		try {
			if(typeof(document.getElementById('editor1').EscapeUnicode) == 'undefined') {
				throw "Error"
			} else {
				document.getElementById('editor1').EscapeUnicode = true;
				document.getElementById('ProductDescription').value = document.getElementById('editor1').value;
			}			
		}
		catch(er) {
			document.getElementById('ProductDescription').value = document.getElementById('alternate1').value;
		}
	}
//]]>
</script>

<h2>Adding New Product in <?php echo implode(' -> ', $this->params['bread'])?></h2>
<?php echo $form->create('Product', array('type' => 'file', 'action' => 'add/' . implode('/', $this->params['bread']), 'onsubmit' => 'move()')); ?>
<?php echo $form->input('model', array('div' => 'input model')); ?>
<?php echo $form->input('name', array('size' => '90', 
                                      'div'  => 'input name'
                        )); ?>
<?php echo $form->input('price', array('div' => 'input price')); ?>
<?php echo $form->input('pounds', array('div'=>'input pounds')); ?>
<?php echo $form->input('ounces', array('div'=>'input ounces')); ?>
<object type="application/x-xstandard" id="editor1" width="100%" height="400">
	<param name="Value" value="<?php echo htmlspecialchars($this->data['Product']['description'], ENT_COMPAT) ?>" />
	<textarea name="alternate1" id="alternate1" cols="60" rows="15"><?php echo htmlspecialchars($this->data['Product']['description'], ENT_COMPAT) ?></textarea>
</object>
<?php echo $form->hidden('description'); ?>
<?php echo $form->input('status', array('type'=>'radio', 'options' => array('0' => 'Not In Stock', '1' => 'In Stock', '2'=> 'Not Shown'))); ?>
<?php echo $form->input('image_url', array('type'=>'file')); ?>


<?php echo $form->end('Add'); ?>
