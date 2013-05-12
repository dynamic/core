<?php

class CoreSiteTree extends SiteTreeExtension {
	
	public function MenuChildren() {
		return $this->owner->Children()->filter('ShowInMenus', true);
	}
	
}