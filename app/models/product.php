<?php
class Product extends AppModel {
	var $name = "Product";
	var $order = "Product.order ASC";
	var $belongsTo = array( 'Category' => array('className' => 'Category') );
	var $actsAs = array('Searchable' => array());
}