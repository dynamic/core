<?php

	class AlbumImage extends DataObject{

		private static $singular_name = 'Album Image';
		private static $plural_name = 'Album Images';
		private static $description = 'Image belonging to a single album';

		private static $db = array(
			'Title' => 'Varchar(255)',
			'ImageDescription' => 'HTMLText',//Use ImageDescription as in the past Description conflicts with the static $description
			'Sort' => 'Int'
		);

		private static $has_one = array(
			'Album' => 'AlbumPage',
			'Image' => 'CoreImage'
		);

		private static $has_many = array();
		private static $many_many = array();
		private static $many_many_extraFields = array();
		private static $belongs_many_many = array();

		private static $summary_fields = array(
			'Image.Name' => 'Image Name',
			'Title' => 'Title',
			'GridThumb' => 'Image');

		private static $default_sort = 'Sort';

		public function getCMSFields(){
			$fields = parent::getCMSFields();

			$imageField = new UploadField('Image', 'Image');
			$imageField->getValidator()->allowedExtensions = array('jpg', 'gif', 'png');
			$imageField->setFolderName('Uploads/AlbumImages');
			$imageField->setConfig('allowedMaxFileNumber', 1);

			$fields->addFieldToTab('Root.Main', ReadonlyField::create('Filename')
				->setTitle('Filename')
				->setValue($this->Image()->Name));
			$fields->addFieldToTab('Root.Main', TextField::create('Title')->setTitle('Title'));
			$fields->addFieldToTab('Root.Main', $imageField);
			$fields->addFieldToTab('Root.Main', $desc = HTMLEditorField::create('ImageDescription')->setTitle('Description'));
			$fields->removeFieldFromTab('Root.Main', 'Sort');
			$fields->removeFieldfromTab('Root.Main', 'AlbumID');

			$this->extend('updateCMSFields', $fields);
			return $fields;
		}

		public function GridThumb() {
			$Image = $this->Image();
			if ( $Image )
				return $Image->CMSThumbnail();
			else
				return null;
		}

		public function canCreate($member = null){
			return true;
		}

		public function canEdit($member = null){
			return true;
		}

		public function canView($member = null){
			return true;
		}

		public function canDelete($member = null){
			return true;
		}

	}