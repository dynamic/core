<?php

class NewsHolder extends HolderPage implements HiddenClass {

	// used by Items method in HolderPage
	public static $item_class = 'NewsArticle';

	private static $allowed_children = array('NewsArticle');
	private static $default_child = 'NewsArticle';

	private static $hide_ancestor = "HolderPage";

	public function canCreate($member = null)
    {
        return false;
    }
}

class NewsHolder_Controller extends HolderPage_Controller
{
}
