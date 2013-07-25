<?php

class HolderPage extends Page {
	
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

class HolderPage_Controller extends Page_Controller {
	
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
				'Items' => $this->Items($filter)
			));
		
		}
		
		return $this->Items();
		
	}
	
}