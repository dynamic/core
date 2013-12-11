<?php

class SpiffCategory extends DataObject {

	private static $db = array(
		'Name' => 'Varchar'
	);

	private static $singular_name = 'Category';
	private static $plural_name = 'Categories';

	private static $default_sort = "Name ASC";

}