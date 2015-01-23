<?php

	class EventPage extends DetailPage{

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

		public function onBeforeWrite(){
			parent::onBeforeWrite();
			if(!$this->EndDate){
				$this->EndDate = $this->Date;
			}
		}

	}

	class EventPage_Controller extends DetailPage_Controller{

		public function init(){
			parent::init();



		}

	}