<?php

class CoreSiteTree extends SiteTreeExtension {

	public function updateCMSFields(FieldList $fields) {
		$fields->insertAfter(TextField::create('SubTitle', 'Sub Title'), 'MenuTitle');
	}

	public function MenuChildren() {
		return $this->owner->Children()->filter('ShowInMenus', true);
	}

}