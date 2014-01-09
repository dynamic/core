<?php

	class AlbumPage extends DetailPage{

		private static $db = array();
		private static $has_one = array();
		private static $has_many = array(
			'Images' => 'AlbumImage'
		);
		private static $many_many = array();
		private static $many_many_extraFields = array();
		private static $belongs_many_many = array();

		public function getCMSFields(){
			$fields = parent::getCMSfields();

			$gridField = new GridField('Images', 'Album images', $this->Images(), GridFieldConfig_RelationEditor::create());
			$fields->addFieldToTab('Root.Images', $gridField);

			$fields->extend('updateCMSFields');
			return $fields;
		}

	}

	class AlbumPage_Controller extends DetailPage_Controller{

		public function init(){
			parent::init();

			Requirements::combine_files(
				'Gallery.css',
				array(
					'themes/dynamic-core-theme/css/flexgallery.css',
					'themes/dynamic-core-theme/css/gallery.css'
			));

			Requirements::combine_files(
				'GalleryPage.js',
				array(
					'themes/dynamic-core-theme/javascript/gallery_page_init.js'
			));
		}

	}