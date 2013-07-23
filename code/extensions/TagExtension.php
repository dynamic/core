<?php

class TagExtension extends DataExtension {
	
	static $many_many = array(
		'Tags' => 'Tag'
	);
	
}