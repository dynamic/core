<?php

	class EventPage extends DetailPage implements PermissionProvider{

		private static $singular_name = 'Event';
		private static $plural_name = 'Events';
		private static $description = 'Event page with a Date and Time';

		private static $db = array(
			'Date' => 'Date',
            'EndDate' => 'Date',
			'Time' => 'Time',
            'EndTime' => 'Time'
        );
		private static $has_one = array();
		private static $has_many = array();
		private static $many_many = array();
		private static $many_many_extraFields = array();
		private static $belongs_many_many = array();
		private static $defaults = array(
			'ShowInMenus' => 0
		);

		public function getCMSFields(){
			$fields = parent::getCMSFields();

			DateField::set_default_config('showcalendar',true);

			$fields->addFieldToTab('Root.EventInformation', DateField::create('Date')->setTitle('Event Start Date'));
            $fields->addFieldToTab('Root.EventInformation', DateField::create('EndDate')->setTitle('Event End Date'));
			$fields->addFieldToTab('Root.EventInformation', TimePickerField::create('Time')->setTitle('Event Time'));
            $fields->addFieldToTab('Root.EventInformation', TimePickerField::create('EndTime')->setTitle('Event End Time'));

			$this->extend('updateCMSFields', $fields);

			return $fields;
		}

		public function validate(){
			$result = parent::validate();

			if($this->EndTime && ($this->Time > $this->EndTime)){
				return $result->error('End Time must be later than the Start Time');
			}

			if($this->EndDate && ($this->Date > $this->EndDate)){
                return $result->error('End Date must be equal to the Start Date or in the future');
            }

			return $result;
		}

		public function onBeforeWrite(){
			parent::onBeforeWrite();
			if(!$this->EndDate){
				$this->EndDate = $this->Date;
			}
		}

		/**
		 * @param Member $member
		 * @return boolean
		 */
		public function canView($member = null) {
			return parent::canView($member = null);
		}

		public function canEdit($member = null) {
			return Permission::check('Event_CRUD');
		}

		public function canDelete($member = null) {
			return Permission::check('Event_CRUD');
		}

		public function canCreate($member = null) {
			return Permission::check('Event_CRUD');
		}

		public function providePermissions() {
			return array(
				//'Location_VIEW' => 'Read a Location',
				'Event_CRUD' => 'Create, Update and Delete a Event Page'
			);
		}

	}

	class EventPage_Controller extends DetailPage_Controller{

		public function init(){
			parent::init();



		}

	}