<?php

class CoreSiteTree extends SiteTreeExtension {

	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab('Root.Main', TextField::create('SubTitle', 'Sub Title'), 'Content');
	}

	public function MenuChildren() {
		return $this->owner->Children()->filter('ShowInMenus', true);
	}

}