<?php

class SettingsConfig extends DataExtension {
	
	static $db = array(
		'AddThisProfileID' => 'Varchar(255)'
	);
	
	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab('Root.SocialMedia', $addThisID = new TextField('AddThisProfileID', 'AddThis Profile ID'));
		$addThisID->setRightTitle('Profile ID to be used all across the site (in the format <strong>ra-XXXXXXXXXXXXXXXX</strong>)');
	}
	
}