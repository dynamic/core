<?php

class DetailPage extends Page implements PermissionProvider{

	private static $has_one = array(
		'Image' => 'Image'
	);

	private static $many_many = array(
		'Tags' => 'Tag',
	);

	private static $searchable_fields = array(
		'Title',
		'Tags.ID'
	);

	// exclude child pages from Menu
	public function MenuChildren() {
		return parent::MenuChildren()->exclude('ClassName', 'NewsArticle');
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		// Tag Field
		$TagField = TagField::create('Tags', null, Tag::get(), $this->Tags());
		$TagField->setCanCreate(true);
		$fields->addFieldToTab('Root.Main', $TagField, 'Content');

		// Images
		//$fields->insertBefore(new Tab('Images'), 'Slides');

		$ImageField = UploadField::create('Image', 'Main Image');
		$ImageField->getValidator()->allowedExtensions = array('jpg', 'jpeg', 'gif', 'png');
		$ImageField->setFolderName('Uploads/DetailMain');
		$ImageField->setConfig('allowedMaxFileNumber', 1);
		if($this->stat('customImageRightTitle')){
			$ImageField->setRightTitle($this->stat('customImageRightTitle'));
		}else{
			$ImageField->setRightTitle('Large image displayed near the top of the page');
		}

		$fields->addFieldsToTab('Root.Images', array(
			$ImageField
		));

	    $this->extend('updateCMSFields', $fields);

		return $fields;
	}

    /**
     * @param Member $member
     * @return boolean
     */
    public function canView($member = null) {
        return parent::canView($member = null);
    }

    public function canEdit($member = null) {
        return Permission::check('DetailPage_CRUD');
    }

    public function canDelete($member = null) {
        return Permission::check('DetailPage_CRUD');
    }

    public function canCreate($member = null) {
        return Permission::check('DetailPage_CRUD');
    }

    public function providePermissions() {
        return array(
            //'Location_VIEW' => 'Read a Location',
            'DetailPage_CRUD' => 'Create, Update and Delete a Detail Page'
        );
    }

}

class DetailPage_Controller extends Page_Controller {



}