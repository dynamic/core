<?php

class Spiff extends DataObject {

	private static $db = array(
		'Name' => 'Varchar(255)',
		'Description' => 'HTMLText',
		//'ShowSpiffLink' => 'Boolean'
	);

	private static $has_one = array(
		'Image' => 'Image',
		'PageLink' => 'SiteTree'
	);

	private static $belongs_many_many = array(
		'SectionPages' => 'SectionPage'
	);

	private static $default_sort = 'Name ASC';

    private static $summary_fields = array(
        'Image.CMSThumbnail' => 'Image',
        'Name' => 'Title',
        'Description' => 'Description',
        'PageLink.MenuTitle' => 'Link'
    );

	public function getCMSFields() {

		$ImageField = new UploadField('Image', 'Image');
		$ImageField->getValidator()->allowedExtensions = array('jpg', 'jpeg', 'gif', 'png');
		$ImageField->setFolderName('Uploads/Spiffs');
		$ImageField->setConfig('allowedMaxFileNumber', 1);

		//$fields = parent::getCMSFields();
        $fields = FieldList::create(
            TextField::create('Name', 'Title'),
            $pageLink = TreeDropdownField::create("PageLinkID", "Link", "SiteTree")
                ->setDescription('clear/remove your selection by choosing the currently selected item and hit save'),
            $ImageField,
            //CheckboxField::create('ShowSpiffLink','Show Spiff Link'),
            HTMLEditorField::create('Description')
        );
        
        $this->extend('updateCMSFields', $fields);
        return $fields;
	}

	public function SideBarSpiff(){
		return SpiffManager::SideBarSpiff();
	}

	// return Spiff View
	public function forTemplate() {
		return $this->renderWith('SpiffView');
	}

	// Set permissions, allow all users to access in ModelAdmin
	function canCreate($member=null) {return true;}
	function canView($member=null) {return true;}
	function canEdit($member=null) {return true;}
	function canDelete($member=null) {return true;}

}