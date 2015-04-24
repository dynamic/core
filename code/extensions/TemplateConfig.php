<?php
class TemplateConfig extends DataExtension {

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
			$ImageField,
			CheckboxField::create('LogoDimensionOverride')->setTitle('Logo Dimension Override'),
			NumericField::create('LogoWidth')->setTitle('Logo Width'),
			NumericField::create('LogoHeight')->setTitle('Logo Height')
   			//HeaderField::create('DisplayOptions', 'Display Options'),
		));

		$config = GridFieldConfig_RelationEditor::create();
		//$config->addComponent(new GridFieldBulkEditingTools());
		//$config->addComponent(new GridFieldBulkImageUpload('ImageID', array('Name')));
		if (class_exists('GridFieldSortableRows')) {
            $config->addComponent(new GridFieldSortableRows("SortOrder"));
        }

		$FooterGridField = GridField::create("FooterLinks", "Footer Links", $this->owner->FooterLinks()->sort('SortOrder'), $config);

	    // add FlexSlider, width and height
	    $fields->addFieldsToTab("Root.Footer", array(
	    	$FooterGridField
	    ));

    }

    public function getSiteLogo() {
    	$gd = $this->owner->Logo();
    	$data = $this->owner->Data();
	    if ($data->LogoDimensionOverride==true&&$data->LogoWidth!=0&&$data->LogoHeight!=0) {
	    	if(($gd->getWidth()==$data->LogoWidth&&$gd->getHeight()==$data->LogoHeight)||($gd->getWidth()<$data->LogoWidth&&$gd->getHeight()<$data->LogoHeight)){
	    		return $gd;
	    	}else{
	    		return $gd->setRatioSize($data->LogoWidth,$data->LogoHeight);
	    	}
    	} else {
    		return $gd;
    	}
    }

    public function getFooterLinkList() {
	    return $this->owner->FooterLinks()->sort('SortOrder');
    }

}