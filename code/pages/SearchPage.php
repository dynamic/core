<?php

class SearchPage extends Page {

	static $singular_name = "Search Page";
	static $plural_name = "Search Pages";
	static $description = 'Website search. Searches Title and Content field of each page.';

	static $defaults = array(
		'ShowInMenus' => 0
	);

}

class SearchPage_Controller extends Page_Controller {



}