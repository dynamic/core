<?php

class CollectionPage extends Page {
	
	static $singular_name = "Collection Page";
	static $plural_name = "Collection Pages";
	static $description = "Displays list of Detail Pages";

	static $allowed_children = array('DetailPage');
	static $default_child = 'DetailPage';
	
	// tag list for sidebar
	public function getTags() {
		
		$hit = Tag::get()
			->filter(array(
				'Pages.ID:GreaterThan'=>0,
				'Pages.ID.ParentID' => $this->ID))
			->sort('Title', 'DESC');
		if($hit->Count()==0){
			$hit = false;
		}
		return $hit;
	}
		
}

class CollectionPage_Controller extends Page_Controller {
	
	private static $allowed_actions = array(
		'tag'
	);
	
	// get child detail pages of this page
	public function Items($pageSize = 10){
		$items = DetailPage::get()
			->filter(array(
				'ParentID' => $this->ID));
		
		$list = PaginatedList::create($items, $this->request);
		//$list->setPageLength($pageSize);
		return $list;
		
	}
	
	public function tag($pageSize = 10) {
		$request = $this->request;
		$params = $request->allParams();
		
		if ($tag = Convert::raw2sql($params['ID'])) {
		
			$items = DetailPage::get()
				->filter(array(
					'ParentID' => $this->ID,
					'Tags.Title' => $tag));
					
			$list = PaginatedList::create($items, $this->request);
			//$list->setPageLength($pageSize);
			
			return $this->customise(array(
				'Filter' => 'Items tagged with "' . $tag . '"',
				'Items' => $list
			));
		}
	}
	
}