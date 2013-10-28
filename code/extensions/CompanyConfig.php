<?php

class CompanyConfig extends DataExtension {

	public function updateCMSFields(FieldList $fields) {

		$fields->addFieldsToTab('Root.Address', array(
			HeaderField::create('CompanyInfo', 'Company Information'),
			LiteralField::create('EnterInfo',
				'<p>Enter your company contact information, which will be used throughout your website</p>'),
			TextField::create('CompanyName', 'Company Name'),
			TextField::create('PhoneNumber', 'Phone Number'),
			TextField::create('EmailAddress', 'Email Address'),
			TextareaField::create('Hours')
		));

		$fields->insertAfter(CheckboxField::create('ShowDirections', 'Show Map and Driving Directions'), 'Country');

	}

}