<?php

class NewsHolder extends HolderPage {

	static $singular_name = "News Page";
	static $plural_name = "News Pages";
	static $description = "Displays list of News Articles";
	
	// used by Items method in HolderPage
	public static $item_class = 'NewsArticle';

	static $allowed_children = array('NewsArticle');
	static $default_child = 'NewsArticle';
	
	static $hide_ancestor = "HolderPage";

}

class NewsHolder_Controller extends HolderPage_Controller {
	
	private static $allowed_actions = array(
		'tag',
		'archive',
		'rss'
	);
		
	// News Archives
	public function getNewsArchive() {
		return GroupedList::create(NewsArticle::get()
			->filter(array('ParentID'=>$this->Data()->ID))
			->sort('DateAuthored', 'DESC'));
	}

}