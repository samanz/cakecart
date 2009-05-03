<?php
class Product extends AppModel {
	var $name = "Product";
	var $order = "Product.order ASC";
	var $belongsTo = array( 'Category' => array('className' => 'Category'), 'Brand' => array('className' => 'Brand'));
	var $actsAs = array('Searchable' => array());
	var $hasMany = array('Images' => array('className' => 'Image'));
	var $hasAndBelongsToMany = array('Option' =>
		                              array('className'    => 'Option',
		                                    'joinTable'    => 'products_options',
		                                    'foreignKey'   => 'product_id',
		                                    'associationForeignKey' => 'option_id',
		                                    'unique'       => false
		                              )
		                           );
}