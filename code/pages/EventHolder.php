<?php

	class EventHolder extends HolderPage{

		public static $item_class = 'EventPage';
		private static $allowed_children = array('EventPage');
		private static $singular_name = 'Event Holder';
		private static $plural_name = 'Events Holder';
		private static $description = 'Page holding events, displays child pages that are events';

        private static $timezone = 'America/Chicago';

        private static $db = array(
            'ICSFeed' => 'Varchar(255)',
            'EventsPerPage' => 'Int',//0 == All
            'RangeToShow' => 'Enum("Month,Year,All Upcoming","Month")'//TODO add day option, bug in getFeedEvents date logic
        );

        public function getCMSFields(){
            $fields = parent::getCMSFields();

            $fields->addFieldToTab('Root.Main', TextField::create('ICSFeed')->setTitle('ICS Feed URL'), 'Content');
            $fields->addFieldToTab(
                'Root.Main',
                DropdownField::create(
                    'RangeToShow',
                    'Range to show',
                    singleton('EventHolder')->dbObject('RangeToShow')->enumValues()
                ),
                'Content'
            );
            $fields->addFieldToTab(
                'Root.Main',
                NumericField::create(
                    'EventsPerPage'
                )->setTitle('Events to show per page (0 shows all based on the "Rage to show")'),
                'Content'
            );

            return $fields;
        }

        public function getFeedEvents($start_date = null, $end_date = null) {
            $start = sfDate::getInstance(strtotime('now'));
            $end_date = $this->buildEndDate($start);

            // single day views don't pass end dates
            if ($end_date) {
                $end = sfDate::getInstance($end_date);
            } else {
                $end = false;
            }

            $feedevents = new ArrayList();
            $feedreader = new ICSReader( $this->ICSFeed );
            $events = $feedreader->getEvents();
            foreach ( $events as $event ) {
                // translate iCal schema into CalendarAnnouncement schema (datetime + title/content)
                $feedevent = new EventPage;
                $feedevent->Title = $event['SUMMARY'];
                if ( isset($event['DESCRIPTION']) ) {
                    $feedevent->Content = $event['DESCRIPTION'];
                }

                $startdatetime = $this->iCalDateToDateTime($event['DTSTART']);
                $enddatetime = $this->iCalDateToDateTime($event['DTEND']);

                if (($end!==false) && (($startdatetime->get() < $start->get() && $enddatetime->get() < $start->get())
                    || $startdatetime->get() > $end->get() && $enddatetime->get() > $end->get())) {
                    // do nothing; dates outside range
                } else {
                    if($startdatetime->get() > $start->get()){
                        $feedevent->Date = $startdatetime->format('Y-m-d');
                        $feedevent->Time = $startdatetime->format('H:i:s');

                        $feedevent->EndDate = $enddatetime->format('Y-m-d');
                        $feedevent->EndTime = $enddatetime->format('H:i:s');

                        $feedevents->push($feedevent);
                    }
                }
            }
            return $feedevents;
        }

        public function iCalDateToDateTime($date) {
            date_default_timezone_set($this->stat('timezone'));
            $date = str_replace('T', '', $date);//remove T
            $date = str_replace('Z', '', $date);//remove Z
            $date = strtotime($date);
            $date = $date + date('Z');
            return sfDate::getInstance($date);
        }

        public function buildEndDate($start = null){
            if($start === null) $start = sfDate::getInstance(strtotime('now'));

            switch($this->RangeToShow){
                case 'Day':
                    $end_date = $start;
                    break;
                case 'Year':
                    $end_date = date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day"));
                    break;
                case 'All Upcoming':
                    $end_date = false;
                    break;
                default:
                    $end_date = date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 1 month"));
                    break;
            }
            return $end_date;
        }

		public static function getUpcomingEvents($filter = null, $limit = 10){

			if($filter===null){
				$filter = array('Date:GreaterThanOrEqual' => date('Y-m-d',strtotime('now')));
			}
			$events = ($limit == 0) ?
				EventPage::get()
					->filter($filter)
					->sort('Date', 'ASC')

			:
            EventPage::get()
                ->filter($filter)
                ->limit($limit)
                ->sort('Date', 'ASC');

            return $events;

		}

        public function getEvents($filter = null, $limit = 10){
            $eventList = ArrayList::create();
            $events = self::getUpcomingEvents($filter, $limit);
            $eventList->merge($events);
            if($this->ICSFeed){
                $icsEvents = $this->getFeedEvents();
                $eventList->merge($icsEvents);
            }
            return $eventList;
        }

		public function getItemsShort(){
			return EventPage::get()
				->limit(3)
				->filter(array(
					'Date:LessThan:Not' => date('Y-m-d',strtotime('now')),
					'ParentID' => $this->ID))
				->sort('Date', 'ASC');
		}

        /**
         * @param Member $member
         * @return boolean
         */
        public function canView($member = null) {
            return parent::canView($member = null);
        }

        public function canEdit($member = null) {
            return Permission::check('EventHolder_CRUD');
        }

        public function canDelete($member = null) {
            return Permission::check('EventHolder_CRUD');
        }

        public function canCreate($member = null) {
            return Permission::check('EventHolder_CRUD');
        }

        public function providePermissions() {
            return array(
                //'Location_VIEW' => 'Read a Location',
                'EventHolder_CRUD' => 'Create, Update and Delete an Event Holder Page'
            );
        }

	}

	class EventHolder_Controller extends HolderPage_Controller{

		public function init(){
			parent::init();

		}

		public function items($filter = array(), $pageSize = 10){
            return $this->getUpcomingEvents();
		}

		public function getUpcomingEvents($paginate = true){
            $pageSize = ($this->data()->EventsPerPage == 0) ? 10 : $this->data()->EventsPerPage;

			$filter = array(
                'EndDate:GreaterThanOrEqual' => date('Y-m-d', strtotime('now')),
				'ParentID' => $this->data()->ID
			);
            if($this->data()->RangeToShow != 'All Upcoming'){
                $end_date = $this->data()->buildEndDate();
                $filter['Date:LessThanOrEqual'] = $end_date;
            }
			$items = $this->data()->getEvents($filter, 0);

            $newItems = $items->sort(
                array(
                    'Date' => 'ASC',
                    'Time' => 'ASC'
                )
            );

            //debug::show($newItems);
            if($paginate === true){
                $list = PaginatedList::create($newItems, $this->request);
                $list->setPageLength($pageSize);
            }else{
                $list = $newItems;
            }


            return $list;
		}

	}