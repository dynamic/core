<?php

	class EventHolder extends HolderPage{

		public static $item_class = 'EventPage';
		private static $allowed_children = array('EventPage');
		private static $singular_name = 'Event Holder';
		private static $plural_name = 'Events Holder';
		private static $description = 'Page holding events, displays child pages that are events';

		public static function getUpcomingEvents($filter = null, $limit = 10, $allCalendars = false){

			if($filter===null){
				$filter = array('Date:LessThan:Not' => date('Y-m-d',strtotime('now')));
			}
			if($limit == 0){
				return EventPage::get()
					->filter($filter)
					->sort('Date', 'ASC');

			}
			return EventPage::get()
				->filter($filter)
				->limit($limit)
				->sort('Date', 'ASC');

		}

		public function getItemsShort(){
			return EventPage::get()
				->limit(3)
				->filter(array(
					'Date:LessThan:Not' => date('Y-m-d',strtotime('now'))
					'ParentID' => $this->ID))
				->sort('Date', 'ASC');
		}



	}

	class EventHolder_Controller extends HolderPage_Controller{

		public function init(){
			parent::init();

		}

		public function items($filter = array(), $pageSize = 10){

		}

	}