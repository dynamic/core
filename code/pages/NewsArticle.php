<?php

class NewsArticle extends HolderItem {

	static $singular_name = "News Article";
	static $plural_name = "News Articles";	
	static $description = "Article for the News section";
	
	// used to determine parent page class
	public static $listing_page_class = 'NewsHolder';
	
	static $default_parent = 'NewsHolder';
	static $can_be_root = false;
	
	static $hide_ancestor = "HolderItem";
	
	static $db = array(
		'DateAuthored' => 'SS_Datetime',
		'Author' => 'Varchar(255)',
		'Featured' => 'Boolean'
	);

	static $defaults = array(
		'ShowInMenus' => 0
	);
	
	static $default_sort = array(
		'DateAuthored' => 'DESC'
	);
		

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
    
    // summary
    public function getSummary() {
	    return $this->renderWith('NewsSummary', 'DetailListSummary');
    }
	
}

class NewsArticle_Controller extends HolderItem_Controller {
	
	
	
}