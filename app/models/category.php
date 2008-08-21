<?php
class Category extends AppModel 
{
   var $name = 'Category';
	 var $order = 'Category.order ASC';
	 var $hasMany = array(
						 			'SubCategory' =>
				              array('className' 	=> 'Category',
								         		'order'      	=> '`order` ASC',
				                           'foreignKey' 	=> 'parent_id'
								   					),
								  'Products' =>
											array('className' 	=> 'Product',
														'order'		=> '`order` ASC',
														'foreignKey'=> 'category_id'
											)
                     );
	function theRoots() {
		return $this->findAllByParentId(0);
	}
	function getTree()
	{
		$this->unbindModel(
			array('hasMany' => array('SubCategory', 'Products'))
		);
		$data = $this->findAll(null,null,"Category.parent_id ASC");
		
		$rows = array();
		foreach($data as $row) 
		{
			 $rows[$row['Category']['id']] = $row;
		
			 if ($row['Category']['parent_id'] == 0)
				  $roots[] = $row['Category']['id'];
		}
		//die(print_r($data));
		while (count(array_diff(array_keys($rows), $roots)) > 0) 
		{
			 $theLeaves = $this->_getLeaves($rows);
			 
			 foreach ($theLeaves as $leafId) 
			 {
				  $rows[$rows[$leafId]['Category']['parent_id']]['SubCategory'][$leafId] = $rows[$leafId];
				  unset($rows[$leafId]);
			 }
			 
		}
		//die(pr($rows));
		return $rows;
	}
	
	function _getLeaves($array) 
	{
		
		
		 $parents = array();
		 $candidates = array();
		 $leaves = array();
		 foreach ($array as $row) {
			  $parents[] = $row['Category']['parent_id'];
			  if ($row['Category']['parent_id'] != 0)
				   $candidates[] = $row['Category']['id'];
		 }
		 $leaves = array_diff($candidates, $parents);
		 return $leaves;
	}
	
}	
?>