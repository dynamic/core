<?php

class SettingsConfig extends DataExtension {

	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab('Root.SocialMedia', $addThisID = new TextField('ShareThisPublisherID', 'ShareThis Publisher ID'));
		$addThisID->setRightTitle('Publisher ID to be used across the site for ShareThis icons');
	}

}