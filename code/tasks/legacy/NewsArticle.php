<?php

class NewsArticle extends HolderItem implements HiddenClass
{

	// used to determine parent page class
	public static $listing_page_class = 'NewsHolder';

	private static $default_parent = 'NewsHolder';
	private static $can_be_root = false;

	private static $hide_ancestor = "HolderItem";

	private static $db = array(
		'DateAuthored' => 'SS_Datetime',
		'Author' => 'Varchar(255)',
		'Featured' => 'Boolean'
	);

	public function canCreate($member = null)
	{
		return false;
	}
}

class NewsArticle_Controller extends HolderItem_Controller
{
}
