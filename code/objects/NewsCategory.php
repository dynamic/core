<?php

class NewsCategory extends DataObject {
	
	static $has_many = array(
		'NewsItems' => 'NewsPage'
	);

	static $db = array(
		'Title' => 'Varchar(255)'
	);

	public function getLink() {
		$newsHolder = NewsLandingPage::get_one('NewsLandingPage');
		if ($newsHolder) {
			return $newsHolder->Link() . '?category=' . $this->ID;
		}
	}
	
}