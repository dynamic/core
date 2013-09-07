<?php

class DetailPage extends Page {
	
	public static $has_one = array(
		'Image' => 'CoreImage'
	);
	
	static $many_many = array(
		'Tags' => 'Tag',
		'Links' => 'LinkObject'
	);
	
	public static $many_many_extraFields = array(
		'Links' => array(
			'SortOrder' => 'Int'
		)
	);
	
	static $singular_name = "Detail Page";
	static $plural_name = "Detail Pages";	
	static $description = "Rich content page, includes images and slides";
	
	public static $searchable_fields = array(
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
		$TagField = TagField::create('Tags', null, null, 'DetailPage');
		$TagField->setSeparator(', ');
		$fields->addFieldToTab('Root.Main', $TagField, 'Content');
		
		// Images
		//$fields->insertBefore(new Tab('Images'), 'Slides');
		
		$ImageField = UploadField::create('Image', 'Main Image');
		$ImageField->getValidator()->allowedExtensions = array('jpg', 'jpeg', 'gif', 'png');
		$ImageField->setFolderName('Uploads/DetailMain');
		$ImageField->setConfig('allowedMaxFileNumber', 1);
		$ImageField->setRightTitle('Large image displayed near the top of the page');
		
		$fields->addFieldsToTab('Root.Images', array(
			$ImageField
		));
		
	    // Side Bar
	    // Links
		$gridFieldConfig = GridFieldConfig_RelationEditor::create();
		$gridFieldConfig->addComponents(new GridFieldSortableRows('SortOrder'));
	    $LinksField = GridField::create("Links", "Links", $this->Links()->sort('SortOrder'), $gridFieldConfig);
	    
	    $fields->addFieldsToTab('Root.SideBar', array(
	    	$LinksField
	    ));
	    
	    if(class_exists('DisplayLogicFormField')){
		    $abstract->displayUnless('AbstractFirstParagraph')->isChecked();
	    }
	    
		return $fields;
	}
	
}

class DetailPage_Controller extends Page_Controller {
	
	
	
}