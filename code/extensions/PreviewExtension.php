<?php

class PreviewExtension extends DataExtension {

	private static $has_one = array(
		'Thumbnail' => 'CoreImage'
	);

	public function updateCMSFields(FieldList $fields) {

		$ThumbField = UploadField::create('Thumbnail', 'Thumbnail Image');
		$ThumbField->getValidator()->allowedExtensions = array('jpg', 'jpeg', 'gif', 'png');
		$ThumbField->setFolderName('Uploads/DetailThumb');
		$ThumbField->setConfig('allowedMaxFileNumber', 1);
		$ThumbField->setRightTitle('Small image used in summary');

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

}