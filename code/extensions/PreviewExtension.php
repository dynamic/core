<?php

class PreviewExtension extends DataExtension {

	private static $db = array(
		'PreviewTitle' => 'HTMLVarchar',
		'Abstract' => 'HTMLText',
		'AbstractFirstParagraph' => 'Boolean');

	private static $has_one = array(
		'Thumbnail' => 'Image'
	);

	public function updateCMSFields(FieldList $fields) {

		$ThumbField = UploadField::create('Thumbnail', 'Thumbnail Image');
		$ThumbField->getValidator()->allowedExtensions = array('jpg', 'jpeg', 'gif', 'png');
		$ThumbField->setFolderName('Uploads/DetailThumb');
		$ThumbField->setConfig('allowedMaxFileNumber', 1);
		if($this->owner->stat('customThumbnailTitle')){
			$ThumbField->setRightTitle($this->owner->stat('customThumbnailTitle'));
		}else{
			$ThumbField->setRightTitle('Small image used in summary');
		}
		$ThumbField->getValidator()->setAllowedMaxFileSize(CORE_IMAGE_FILE_SIZE_LIMIT);

		// Preview
	    $fields->addFieldsToTab('Root.Preview', array(
	    	TextField::create('PreviewTitle', 'Preview Title'),
	    	CheckboxField::create('AbstractFirstParagraph','Use first paragraph as abstract'),
	    	$abstract = TextareaField::create('Abstract'),
	    	$ThumbField
	    ));

		if(class_exists('DisplayLogicFormField')){
		    $abstract->displayUnless('AbstractFirstParagraph')->isChecked();
	    }

	}

	// summary for list layout
	public function getSummary() {
		return $this->owner->renderWith('DetailListSummary');
	}

	// summary for text grid layout
	public function getTextGridSummary() {
		return $this->owner->renderWith('DetailTextGridSummary');
	}

	// summary for image grid layout
	public function getImageGridSummary() {
		return $this->owner->renderWith('DetailImageGridSummary');
	}

	// getters for summary view
	public function getPreviewHeadline() {
		if ($this->owner->PreviewTitle) {
			return $this->owner->obj('PreviewTitle');
		} elseif ($this->owner->Title) {
			return $this->owner->Title;
		}
		return false;
	}

	public function getPreviewThumb() {
		if ($this->owner->ThumbnailID) {
			return $this->owner->Thumbnail();
		} elseif ($this->owner->ImageID) {
			return $this->owner->Image();
		}
		return false;
	}

	public function getPreviewAbstract(){
		if(!$this->owner->AbstractFirstParagraph&&$this->owner->Abstract){
			return $this->owner->Abstract;
		}elseif((!$this->owner->AbstractFirstParagraph&&!$this->owner->Abstract)||$this->owner->AbstractFirstParagraph){
			$content = $this->owner->obj('Content');
			return $content->FirstParagraph();
		}
	}

}