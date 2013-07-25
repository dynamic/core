<?php

class DetailPage extends Page {
	
	public static $db = array(
		'PreviewTitle' => 'Varchar(255)',
		'Abstract' => 'Text',
		'AbstractFirstParagraph' => 'Boolean',
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
	
	public static $searchable_fields = array(
		'Title',
		'Tags.ID'
	);
	
	// exclude child pages from Menu
	public function MenuChildren() {
		return parent::MenuChildren()->exclude('ClassName', 'NewsArticle');
	}

	public function getDefaultRSSLink() {
		return $this->Link('rss');
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
	    	TextareaField::create('Abstract'),
	    	CheckboxField::create('AbstractFirstParagraph','Use first paragraph as abstract')
	    ));
	    
	    // Side Bar
	    // Links
		$gridFieldConfig = GridFieldConfig_RelationEditor::create();
		$gridFieldConfig->addComponents(new GridFieldSortableRows('SortOrder'));
	    $LinksField = GridField::create("Links", "Links", $this->Links()->sort('SortOrder'), $gridFieldConfig);
	    
	    $fields->addFieldsToTab('Root.Side Bar', array(
	    	$LinksField
	    ));
	    
		return $fields;
	}
	
	// summary for collection page
	public function getSummary() {
		return $this->renderWith('DetailSummary');
	}
	
	// getters for summary view
	public function getPreviewTitle() {
		if ($this->PreviewTitle) {
			return $this->PreviewSubTitle;
		} elseif ($this->Title) {
			return $this->Title;
		}
		return false;
	}
	
	// getters for relations
	public function getLinkList() {
		return $this->Links()->sort('SortOrder');
	}
	
}

class DetailPage_Controller extends Page_Controller {
	
	public function init() {
		RSSFeed::linkToFeed($this->Link('rss'), $this->Data()->Title.' rss feed');
		parent::init();
	}
	
	public function rss() {
		$title = $this->Data()->Title;
		$description = "$title rss feed";
		$rss = new RSSFeed(
			$this->getItems(),
			$this->Link('rss'),
			$this->Data()->Title,
			$description);
		return $rss->outputToBrowser();
	}
	
}