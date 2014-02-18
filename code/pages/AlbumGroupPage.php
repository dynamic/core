<?php

	class AlbumGroupPage extends HolderPage{

		private static $singular_name = 'Album Group Page';
		private static $plural_name = 'Album Group Pages';
		private static $description = 'Page holding all albums in the site';

		private static $default_child = 'AlbumPage';
		private static $allowed_children = array('AlbumPage');

		private static $db = array(
			'Overlay' => 'Boolean',
			'LimitListSize' => 'Boolean',
			'ListSize' => 'Int');

		public static $item_class = 'AlbumPage';

		public function getCMSFields(){
			$fields = parent::getCMSFields();

			$fields->addFieldToTab('Root.Settings', CheckboxField::create('Overlay')->setTitle('Show albums in overlay'));
			$fields->addFieldToTab('Root.Settings', CheckboxField::create('LimitListSize')->setTitle('Limit list size'));
			$fields->addFieldToTab('Root.Settings', $limitInt = NumericField::create('ListSize')->setTitle('List size'));
			
			if(class_exists('DisplayLogicFormField')){
				$limitInt->displayIf('LimitListSize')->isChecked();
			}

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
		
		public function Items($filter = array(), $pageSize = 10) {

			$filter['ParentID'] = $this->Data()->ID;
			$class =  $this->Data()->stat('item_class');
	
			// get all records from $class using $filter
			$items = $class::get()->filter($filter);
			
			if($this->Data()->LimitListSize){
				$list = PaginatedList::create($items, $this->request);
				
				$listSize = ($this->Data()->ListSize) ? $this->Data()->ListSize : $pageSize;
				
				$list->setPageLength($listSize);
			}else{
				$list = $items;
			}
	
			return $list;
	
		}

	}