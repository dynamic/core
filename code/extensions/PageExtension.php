<?php

class PageExtension extends DataExtension {
	
	static $db = array(
		'SubTitle' => 'Varchar(255)'
	);
	
	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab('Root.Main', TextField::create('SubTitle', 'Sub Title'), 'Content');
	}
	
}