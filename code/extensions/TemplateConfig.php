<?php
class TemplateConfig extends DataExtension {

	static $db = array(
		'TitleLogo' => 'enum("Logo, Title")'
	);
	
	static $has_one = array(
		'Logo' => 'Image'
	);
	
	static $many_many = array(
		'FooterLinks' => 'SiteTree'
	);
	
	static $many_many_extraFields = array(
		'FooterLinks' => array(
			'SortOrder' => 'Int'
		)
	);
	
	static $defaults = array(
		'TitleLogo' => 'Title'
	);
	
    public function updateCMSFields(FieldList $fields) {
    
		$ImageField = UploadField::create('Logo');
		$ImageField->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
		$ImageField->setFolderName('Uploads/Logo');
		$ImageField->setConfig('allowedMaxFileNumber', 1);
		
		// options for logo or title display
		$logoOptions = array('Title' => 'Display Site Title and Slogan', 'Logo' => 'Display Logo');
		
		$fields->addFieldsToTab('Root.Header', array(
			OptionsetField::create('TitleLogo', 'Branding', $logoOptions),
			$ImageField//,
   			//HeaderField::create('DisplayOptions', 'Display Options'),
   			
		));
		
		$config = GridFieldConfig_RelationEditor::create();	
		//$config->addComponent(new GridFieldBulkEditingTools());
		//$config->addComponent(new GridFieldBulkImageUpload('ImageID', array('Name')));
		$config->addComponent(new GridFieldSortableRows("SortOrder"));
	    
		$FooterGridField = GridField::create("FooterLinks", "Footer Links", $this->owner->FooterLinks()->sort('SortOrder'), $config);
	    	    
	    // add FlexSlider, width and height
	    $fields->addFieldsToTab("Root.Footer", array(
	    	$FooterGridField
	    ));
		        		
    }
    
    public function getSiteLogo() {
    	$gd = $this->owner->Logo();
	    if ($gd->getHeight() > 80 || $gd->getWidth() > 280) {
    		return $gd->setRatioSize(280,80);
    	} else {
    		return $gd;
    	}
    }

    public function getFooterLinkList() {
	    return $this->owner->FooterLinks()->sort('SortOrder');
    }
                  
}