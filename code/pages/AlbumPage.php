<?php

	class AlbumPage extends DetailPage{

		private static $singular_name = 'Album';
		private static $plural_name = 'Albums';
		private static $description = 'Album containing images';
		private static $default_parent = 'AlbumGroupPage';
		private static $can_be_root = false;

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

			$config = GridFieldConfig_RelationEditor::create();
			//$config->addComponent(new GridFieldBulkImageUpload());
			//$config->addComponent(new GridFieldBulkManager());
			//$config->addComponent(new GridFieldManyRelationHandler(), 'GridFieldPaginator');
			$config->addComponent(new GridFieldSortableRows('Sort'));
			$gridField = new GridField('Images', 'Album images', $this->Images()->sort('Sort'), $config);
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