<?php

class DetailPage extends Page {
	
	public static $db = array(
		'PreviewTitle' => 'Varchar(255)',
		//'PreviewSubTitle' => 'Varchar(255)',
		'Abstract' => 'Text',
		'AbstractFirstParagraph' => 'Boolean',
	);
	
	public static $has_one = array(
		'Thumbnail' => 'CoreImage',
		'Image' => 'CoreImage'
	);
	
	// getters for Thumbnail Previews
	public function getPreviewTitle() {
		if ($this->PreviewTitle) {
			return $this->PreviewSubTitle;
		} elseif ($this->Title) {
			return $this->Title;
		}
		return false;
	}
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		
		// Tag Field
		$TagField = TagField::create('Tags', null, null, 'Page');
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
	    	TextareaField::create('Abstract'),
	    	CheckboxField::create('AbstractFirstParagraph','Use first paragraph as abstract')
	    ));
	    
		return $fields;
	}
	
	// summary for collection page
	public function getSummary() {
		return $this->renderWith('DetailSummary');
	}
	
	// getters for relations
	public function getLinkList() {
		return $this->Links()->sort('SortOrder');
	}
	
}

class DetailPage_Controller extends Page_Controller {
	
	
	
}