<?php

class NewsArticle extends DetailPage {

	static $singular_name = "News Article";
	static $plural_name = "News Articles";	
	static $description = "Article for the News section";
	
	static $default_parent = 'NewsLandingPage';
	static $can_be_root = false;
	
	static $db = array(
		'DateAuthored' => 'SS_Datetime',
		'Author' => 'Varchar(255)',
		'Featured' => 'Boolean');

	static $has_one = array();
	static $has_many = array();
	static $many_many = array(
		'Categories' => 'NewsCategory');
	static $belongs_many_many = array();
	
	static $defaults = array(
		'ShowInMenus' => 0
	);
	
	static $default_sort = array(
		'DateAuthored' => 'DESC');

	/**
	 * Add the default for the Date being the current day.
	 */
	public function populateDefaults() {
		parent::populateDefaults();

		if(!isset($this->DateAuthored) || $this->DateAuthored === null) {
			$this->DateAuthored = SS_Datetime::now()->Format('Y-m-d H:i:s');
		}
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', $dateTimeField = new DatetimeField('DateAuthored'), 'Content');
		$dateTimeField->getDateField()->setConfig('showcalendar', true);
		
		//$fields->addFieldToTab('Root.Main', new CheckboxField('Featured','Featured Story'),'Content');

		return $fields;
	}
	
	// News Archive Grouping
	public function getMonthCreated() {
        return date('F Y', strtotime($this->DateAuthored));
    }
	
}

class NewsArticle_Controller extends DetailPage_Controller {
	
	
	
}