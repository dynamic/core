<?php

class NewsArticle extends HolderItem implements PermissionProvider{

	// used to determine parent page class
	public static $listing_page_class = 'NewsHolder';

	private static $default_parent = 'NewsHolder';
	private static $can_be_root = false;

	private static $hide_ancestor = "HolderItem";

	private static $db = array(
		'DateAuthored' => 'SS_Datetime',
		'Author' => 'Varchar(255)',
		'Featured' => 'Boolean'
	);

	private static $defaults = array(
		'ShowInMenus' => 0
	);

	private static $default_sort = array(
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

		$fields->addFieldToTab('Root.Main', TextField::create('Author'), 'Content');
		$fields->addFieldToTab('Root.Main', $dateTimeField = new DatetimeField('DateAuthored'), 'Content');
		$dateTimeField->getDateField()->setConfig('showcalendar', true);

		$this->extend('updateCMSFields', $fields);

		return $fields;
	}

	/***
	 * @return bool|string
	 */
	public function getMonthCreated() {
        return ($this->DateAuthored) ? date('F Y', strtotime($this->DateAuthored)) : false;
    }

	/***
	 * @return bool|string
	 */
	public function getYearCreated() {
		return ($this->DateAuthored) ? date('Y', strtotime($this->DateAuthored)) : false;
	}

    // summary
    public function getSummary() {
	    return $this->renderWith('NewsSummary', 'DetailListSummary');
    }

	/**
	 * @param Member $member
	 * @return boolean
	 */
	public function canView($member = null) {
		return parent::canView($member = null);
	}

	public function canEdit($member = null) {
		return Permission::check('News_CRUD');
	}

	public function canDelete($member = null) {
		return Permission::check('News_CRUD');
	}

	public function canCreate($member = null) {
		return Permission::check('News_CRUD');
	}

	public function providePermissions() {
		return array(
			//'Location_VIEW' => 'Read a Location',
			'News_CRUD' => 'Create, Update and Delete a News Article'
		);
	}

}

class NewsArticle_Controller extends HolderItem_Controller {



}