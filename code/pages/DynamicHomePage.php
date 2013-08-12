<?php

class DynamicHomePage extends SectionPage {

	static $singular_name = "Home Page";
	static $plural_name = "Home Pages";	
	static $description = 'Website homepage, includes slides and spiffs';
	
	static $hide_ancestor = "SectionPage";
	
	static $defaults = array(
		'ShowInMenus' => 0
	);
	
}

class DynamicHomePage_Controller extends SectionPage_Controller {
	
	
	
}