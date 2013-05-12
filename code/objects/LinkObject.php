<?php

class LinkObject extends DataObject {
	
	static $db = array(
		'Name' => 'Varchar(255)',
		'URL' => 'Varchar(255)'
	);
	
	static $has_one = array(
		'PageLink' => 'SiteTree'
	);
	
	static $belongs_many_many = array(
		//'Pages' => 'Page'
	);
	
	static $singular_name = 'Link';
	static $plural_name = 'Links';
	
	static $default_sort = 'Name';
	
	static $summary_fields = array(
		'Name' => 'Name',
		'PageLink.MenuTitle',
		'URL' => 'URL'
	);
	
	public function getExternal() {
		if ($url = $this->URL) {
			if (strstr($url, "http://") == $url || strstr($url, "https://") == $url) { 
				return $url;
			} else {
				return 'http://' . $url;
			}
			
		} 
		return false;
	}
	
	public function getCMSFields() {
		$fields = FieldList::create(
			$tabSet = new TabSet('Root',
				$mainTab = new Tab('Main',
					new TextField('Name'),
					new HeaderField('LinkTitle', 'Choose destination'),
					new TreeDropdownField('PageLinkID', 'Page', 'SiteTree'),
					new HeaderField('LinkOr', 'OR', 4),
					new TextField('URL', 'URL (include http:// if external)')
				)
			)
		);
		
		return $fields;
	}
	
	// Set permissions, allow all users to access in ModelAdmin
	function canCreate($member=null) {return true;}
	function canView($member=null) {return true;} 
	function canEdit($member=null) {return true;} 
	function canDelete($member=null) {return true;}

}