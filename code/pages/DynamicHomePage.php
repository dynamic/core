<?php

class DynamicHomePage extends SectionPage {

	private static $singular_name = "Home Page";
	private static $plural_name = "Home Pages";
	private static $description = 'Website homepage, includes slides and spiffs';

	private static $defaults = array(
		'ShowInMenus' => 0
	);

}

class DynamicHomePage_Controller extends SectionPage_Controller {



}