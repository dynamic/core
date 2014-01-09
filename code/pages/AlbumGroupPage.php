<?php

	class AlbumGroupPage extends HolderPage{

		private static $singular_name = 'Album Group Page';
		private static $plural_name = 'Album Group Pages';
		private static $description = 'Page holding all albums in the site';

		private static $db = array(
			'Overlay' => 'Boolean');

		public static $item_class = 'AlbumPage';

		public function getCMSFields(){
			$fields = parent::getCMSFields();

			$fields->addFieldToTab('Root.Main', CheckboxField::create('Overlay')->setTitle('Show albums in overlay'), 'Content');

			$fields->extend('updateCMSFields');
			return $fields;
		}

	}

	class AlbumGroupPage_Controller extends HolderPage_Controller{

		public function init(){
			parent::init();

			if($this->Data()->Overlay){
				Requirements::combine_files(
					'Gallery.css',
					array(
						'themes/dynamic-core-theme/css/flexgallery.css',
						'themes/dynamic-core-theme/css/gallery.css'
				));

				Requirements::combine_files(
					'Gallery.js',
					array(
						'themes/dynamic-core-theme/javascript/flexslider/jquery.flexslider-min.js',
						'themes/dynamic-core-theme/javascript/gallery_init.js'
				));
			}

		}

	}