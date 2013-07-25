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
		'tag',
		'AdvSearchForm'
	);
	
	// get child detail pages of this page
	public function Items($searchCriteria = array(), $pageSize = 10){
	
		$request = ($this->request) ? $this->request : $this->parentController->getRequest();
		if(!$searchCriteria) $searchCriteria = $request->requestVars();
		
		// filter by current page as Parent - doesn't work
		//$searchCriteria['ParentID'] = $this->ID;
		
		$start = ($request->getVar('start')) ? (int)$request->getVar('start') : 0;
		//$sort = ($request->getVar('sort')) ? $request->getVar('sort') : singleton($this->Model)->getCustomSort();
		$limit = 10;
			
		$context = singleton('DetailPage')->getDefaultSearchContext();
		$query = $context->getQuery($searchCriteria/*, $sort*/);
		$records = $context->getResults($searchCriteria/*, $sort*/);
				  
        $records = PaginatedList::create($records, $this->request);
        $records->setPageStart($start);
        $records->setPageLength($pageSize);
	     
	    return $records;
		
	}
	
	// Search Objects
	public function AdvSearchForm() {
		
		$Object = singleton('DetailPage');
		
		$context = $Object->getDefaultSearchContext();
		$fields = $context->getSearchFields();
				
		$actions = new FieldList(
			new FormAction('search', 'Search')
		);
		
		$form = Form::create($this, "AdvSearchForm",
			$fields,
			$actions
		);
		
		$form->setFormMethod('get');

		return $form;
	}
	
	
	// Results filtered by query
	function search($data, $form, $request) {
		$limit = true;
		return $this->render(array(
			'Items' => $this->Items($form->getData()),
			'AdvSearchForm' => $form
		));
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