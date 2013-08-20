<?php

class DetailPage extends Page {
	
	public static $db = array(
		'PreviewTitle' => 'Varchar(255)',
		'Abstract' => 'Text',
		'AbstractFirstParagraph' => 'Boolean'
	);
	
	public static $has_one = array(
		'Thumbnail' => 'CoreImage',
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
		$fields->insertBefore(new Tab('Images'), 'Slides');
		
		$ImageField = UploadField::create('Image', 'Main Image');
		$ImageField->getValidator()->allowedExtensions = array('jpg', 'jpeg', 'gif', 'png');
		$ImageField->setFolderName('Uploads/DetailMain');
		$ImageField->setConfig('allowedMaxFileNumber', 1);
		$ImageField->setRightTitle('Large image displayed near the top of the page');
		
		$ThumbField = UploadField::create('Thumbnail', 'Thumbnail Image');
		$ThumbField->getValidator()->allowedExtensions = array('jpg', 'jpeg', 'gif', 'png');
		$ThumbField->setFolderName('Uploads/DetailThumb');
		$ThumbField->setConfig('allowedMaxFileNumber', 1);
		$ThumbField->setRightTitle('Small image used in summary');
		
		$fields->addFieldsToTab('Root.Images', array(
			$ImageField,
			$ThumbField
		));
		
		// Preview
	    $fields->addFieldsToTab('Root.Preview', array(
	    	TextField::create('PreviewTitle', 'Preview Title'),
	    	//TextField::create('PreviewSubTitle', 'Preview Sub Title'),
	    	CheckboxField::create('AbstractFirstParagraph','Use first paragraph as abstract'),
	    	$abstract = TextareaField::create('Abstract')
	    ));
	    
	    // Side Bar
	    // Links
		$gridFieldConfig = GridFieldConfig_RelationEditor::create();
		$gridFieldConfig->addComponents(new GridFieldSortableRows('SortOrder'));
	    $LinksField = GridField::create("Links", "Links", $this->Links()->sort('SortOrder'), $gridFieldConfig);
	    
	    $fields->addFieldsToTab('Root.Side Bar', array(
	    	$LinksField
	    ));
	    
	    if(class_exists('DisplayLogicFormField')){
		    $abstract->displayUnless('AbstractFirstParagraph')->isChecked();
	    }
	    
		return $fields;
	}
	
	// summary for collection page
	public function getSummary() {
		return $this->renderWith('DetailSummary');
	}
	
	// getters for summary view
	public function getPreviewHeadline() {
		if ($this->PreviewTitle) {
			return $this->PreviewTitle;
		} elseif ($this->Title) {
			return $this->Title;
		}
		return false;
	}
	
	public function getPreviewThumb() {
		if ($this->ThumbnailID) {
			return $this->Thumbnail();
		} elseif ($this->ImageID) {
			return $this->Image();
		} 
		return false;
	}
	
	// getters for relations
	public function getLinkList() {
		return $this->Links()->sort('SortOrder');
	}
	
}

class DetailPage_Controller extends Page_Controller {
	
	
	
}