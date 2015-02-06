<?php

class SearchPage extends Page {

	private static $singular_name = "Search Page";
	private static $plural_name = "Search Pages";
	private static $description = 'Website search. Searches Title and Content field of each page.';

	private static $defaults = array(
		'ShowInMenus' => 0
	);

	public function canCreate($member = null){
		return (SearchPage::get()->first()) ? false : true;
	}

}

class SearchPage_Controller extends Page_Controller {

	/*
	private static $allowed_actions = array(
		'SearchForm'
	);
	*/

}