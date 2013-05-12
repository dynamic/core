<?php

class DynamicHomePage extends Page {

	static $defaults = array(
		'ShowInMenus' => 0
	);

	static $singular_name = "Home Page";
	
	static $plural_name = "Home Pages";
	
	static $description = 'Website homepage, includes image carousel and spiffs';
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName('Content');
		return $fields;
	}
	
}

class DynamicHomePage_Controller extends Page_Controller {
	
	
	
}