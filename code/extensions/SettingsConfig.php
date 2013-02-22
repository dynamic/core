<?php

class SettingsConfig extends DataExtension {
	
	static $db = array(
		'FacebookLogin' => 'Boolean'
	);
	
	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldsToTab('Root.Social', array(
			CheckboxField::create('FacebookLogin', 'Enable Facebook Login by visitors?')
		));
	}
	
}