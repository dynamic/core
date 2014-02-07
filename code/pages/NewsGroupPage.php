<?php

	class NewsGroupPage extends HolderPage{

		private static $singular_name = "News and Events";
		private static $plural_name = 'News and Events';
		private static $description = 'Page holding News Holder and Event Holder pages';

		private static $allowed_children = array('NewsHolder','EventHolder');

		public static $item_class = array('NewsHolder','EventHolder');

		public function getCMSFields(){
			$fields = parent::getCMSFields();



			return $fields;
		}

	}

	class NewsGroupPage_Controller extends HolderPage_Controller{

		public function Items($filter = array(), $pageSize = 10) {

			$filter['ParentID'] = $this->Data()->ID;
			$class =  $this->Data()->stat('item_class');

			if(is_array($class)){
				$items = ArrayList::create();
				foreach($class as $cl){
					$sub = $cl::get()->filter($filter);
					if($sub->count()>1){
						foreach($sub as $item){
							$items->push($item);
						}
					}else{
						$items->push($sub->first());
					}
				}
			}else{
				$items = $class::get()->filter($filter);
			}

			$list = PaginatedList::create($items, $this->request);
			$list->setPageLength($pageSize);

			return $list;

		}

	}