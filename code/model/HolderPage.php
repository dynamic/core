<?php

class HolderPage extends Page {
	
	// tag list for sidebar
	public function getTags() {
		
		$hit = Tag::get()
			->filter(array(
				'Pages.ID:GreaterThan'=>0,
				'Pages.ID.ParentID' => $this->ID))
			//->sort('RelatedPages', 'DESC')
			->limit(15);
		if($hit->Count()==0){
			$hit = false;
		}
		return $hit;
	}
	
	// hide children from menu
	public function MenuChildren() {
		return parent::MenuChildren()->exclude('ClassName', 'HolderItem');
	}
	
}

class HolderPage_Controller extends Page_Controller {

	public function init() {
		RSSFeed::linkToFeed($this->Link('rss'), $this->Data()->Title.' rss feed');
		parent::init();
	}
	
	private static $allowed_actions = array(
		'tag'
	);
	
	public function Items($filter = array(), $pageSize = 10) {
		
		$filter['ParentID'] = $this->Data()->ID;
		$items = DetailPage::get()->filter($filter);
						
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
			$this->getItems(),
			$this->Link('rss'),
			$this->Data()->Title,
			$description);
		return $rss->outputToBrowser();
	}
	
}