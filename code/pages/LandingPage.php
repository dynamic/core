<?php

class LandingPage extends SectionPage {

	private static $singluar_name = "Landing Page";
	private static $plural_name = "Landing Pages";
	private static $description = 'Section Landing Page, displays list of subpages';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->extend('updateCMSFields', $fields);
		return $fields;
	}

}

class LandingPage_Controller extends SectionPage_Controller {



}