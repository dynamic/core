<?php

/**
 * HideExtension class.
 * 
 * Hides a page type from the CMS. Used if page type is not used/allowed.
 * 
 * @extends DataExtension
 */
class HideExtension extends DataExtension {
	
	public function canCreate($member = null){
	   return false; 
	}
	
}