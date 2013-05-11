<?php

class SpiffCategory extends DataObject {

	static $db = array(
		'Name' => 'Varchar'
	);
	
	static $singular_name = 'Category';
	static $plural_name = 'Categories';
	
	static $default_sort = "Name ASC";

}