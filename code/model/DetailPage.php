<?php

class DetailPage extends Page implements PermissionProvider{

	private static $has_one = array(
		'Image' => 'Image'
	);

	private static $many_many = array(
		'Tags' => 'Tag',
		'Links' => 'LinkObject'
	);

	private static $many_many_extraFields = array(
		'Links' => array(
			'SortOrder' => 'Int'
		)
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

	    // Side Bar
	    // Links
		$gridFieldConfig = GridFieldConfig_RelationEditor::create();
		if(class_exists('GridFieldManyRelationHandler')){
			$gridFieldConfig->addComponent(new GridFieldManyRelationHandler(), 'GridFieldPaginator');
			if(class_exists('GridFieldSortableRows')) {
                $gridFieldConfig->addComponent(new GridFieldSortableRows("SortOrder"), 'GridFieldManyRelationHandler');
            }
			$gridFieldConfig->removeComponentsByType('GridFieldAddExistingAutocompleter');
		}else{
			if (class_exists('GridFieldSortableRows')) $gridFieldConfig->addComponent(new GridFieldSortableRows("SortOrder"));
		}
	    $LinksField = GridField::create("Links", "Links", $this->Links()->sort('SortOrder'), $gridFieldConfig);

	    $fields->addFieldsToTab('Root.SideBar', array(
	    	$LinksField
	    ));

		$this->extend('updateCMSFields', $fields);

		return $fields;
	}

	public function getLinks(){
		return $this->getManyManyComponents('Links')->sort('SortOrder');
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