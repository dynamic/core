<?php

class HolderPage extends Page {

	public static $item_class = 'HolderItem';
	private static $singular_name = 'Group Page';
	private static $plural_name = 'Group Pages';
	
	static $hide_ancestor = "HolderPage";

	// tag list for sidebar
	public function getTags() {

		$hit = Tag::get()
			->filter(array(
				'Pages.ID:GreaterThan'=>0,
				'Pages.ClassName' => $this->stat('item_class'),
				'Pages.ID.ParentID' => $this->ID))
			//->sort('RelatedPages', 'DESC')
			->limit(10);
		if($hit->Count()==0){
			$hit = false;
		}
		return $hit;
	}

	// hide children from menu
	public function MenuChildren() {
		return parent::MenuChildren()->exclude('ClassName', 'HolderItem');
	}

	public function getDefaultRSSLink() {
		return $this->Link('rss');
	}

}

class HolderPage_Controller extends Page_Controller {

	public function init() {
		RSSFeed::linkToFeed($this->Link('rss') . '.xml', $this->Data()->Title.' rss feed');
		parent::init();
	}

	private static $allowed_actions = array(
		'tag',
		'rss'
	);

	public function Items($filter = array(), $pageSize = 10) {

		$filter['ParentID'] = $this->Data()->ID;
		$class =  $this->Data()->stat('item_class');

		// get all records from $class using $filter
		$items = $class::get()->filter($filter);

		$list = PaginatedList::create($items, $this->request);
		$list->setPageLength($pageSize);

		return $list;

	}

	public function tag() {

		$request = $this->request;
		$params = $request->allParams();

		if ($tag = Convert::raw2sql($params['ID'])) {

			$filter = array('Tags.Title' => $tag);

			return $this->customise(array(
				'Message' => 'showing entries tagged "' . $tag . '"',
				'Items' => $this->Items($filter)
			));

		}

		return $this->Items();

	}

	public function rss() {
		$title = $this->Data()->Title;
		$description = "$title rss feed";
		$rss = new RSSFeed(
			$this->Items(),
			$this->Link('rss'),
			$this->Data()->Title,
			$description);
		return $rss->outputToBrowser();
	}

}