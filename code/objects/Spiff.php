<?php

class Spiff extends DataObject {

	static $db = array(
		'Name' => 'Varchar',
		'Headline' => 'Varchar',
		'Description' => 'HTMLText'
	);
	
	static $has_one = array(
		'Image' => 'Image',
		'PageLink' => 'SiteTree',
		'Category' => 'SpiffCategory'
	);
	
	static $default_sort = 'Name ASC';
	
	// Custom Table Fields
	function getTableThumb() {
		return $this->Image()->CroppedImage(50,40);
	}
	function getTableTitle() {
		$text = '';
		if ($this->Name) $text .= "<h5 style='margin: 3px 0; padding: 0;'>" . $this->Name . "</h5>";
		if ($this->Headline) $text .= $this->Headline;
		return $text;
	}
	function getTableDescription() {
		return $this->obj('Description')->Summary(40);
	}
	
	public function getCMSFields() {
	
		$categories = DataObject::get('SpiffCategory');
		if ($categories) {
			$categoryList = $categories->Map('ID', 'Name');
		} else {
			$categoryList = null;
		};
		
		$ImageField = new UploadField('Image', 'Image');
		$ImageField->getValidator()->allowedExtensions = array('jpg', 'jpeg', 'gif', 'png');
		$ImageField->setFolderName('Uploads/Spiffs');
		$ImageField->setConfig('allowedMaxFileNumber', 1);
	
		$fields = parent::getCMSFields();
		
		$fields->addFieldsToTab('Root.Main', array(
			new TextField('Name'),
			new TextField('Headline'),
			new TreeDropdownField("PageLinkID", "Page to link to", "SiteTree"),
			new DropdownField('CategoryID', 'Category', $categoryList),
			new HTMLEditorField('Description')
		));
		$fields->addFieldsToTab('Root.Image', array(
			$ImageField
		));
         
        return $fields;
	}
	
	// return Spiff View
	public function forTemplate() {
		return $this->renderWith('SpiffView');
	}

}