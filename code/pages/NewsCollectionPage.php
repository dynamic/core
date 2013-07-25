<?php

class NewsCollectionPage extends CollectionPage {

	static $singular_name = "News Page";
	static $plural_name = "News Pages";
	static $description = "Displays list of News Articles";

	static $allowed_children = array('NewsArticle');
	static $default_child = 'NewsArticle';

	public function getArticles(){
		$articles = NewsArticle::get()
			->filter(array('ParentID' => $this->ID))->sort('Date','DESC')->limit(2);
		return $articles;
	}

}

class NewsCollectionPage_Controller extends CollectionPage_Controller {
	
	/*
	private static $allowed_actions = array(
		'Category',
		'Tag',
		'Archive',
		'rss'
	);
	*/
	
	public function Category(){
		return array();
	}
	
	/*
	public function Tag() {
		return array();
	}
	*/
	
	public function Archive(){
		return array();
	}
			
	public function getNewsItems($pageSize = 10) {
		$request = $this->request;
		$params = $request->allParams();
		
		$data = Controller::curr()->Data();
		if(!$Content = $data->Content){
			$Content = false;
		}
		
		$action = $params['Action'];

		switch($action){
			case 'Archive':
				$year = $params['ID'];
				$month = $params['OtherID'];
				
				$from = date('Y-m-d H:i:s', strtotime($year.'-'.$month.'-01 00:00:00'));
				$monthName = date('F',strtotime($from));
				$toDate = date('Y-m-d', strtotime("last day of $monthName $year"));
				$to = date('Y-m-d H:i:s', strtotime($toDate." 23:59:59"));
				
				$articles = NewsArticle::get()
					->filter(array(
						'ParentID' => $data->ID,
						'DateAuthored:GreaterThan' => $from,
						'DateAuthored:LessThan' => $to))
					->sort('DateAuthored','DESC');
			break;
			case 'Tag':
				$categoryID = $params['ID'];
				$articles = NewsArticle::get()
					->filter(array(
						'ParentID' => $data->ID,
						'Tags.ID' => $categoryID))
					->sort('DateAuthored', 'DESC');
				if($articles->Count()==0){
					$articles = false;
				}
			break;
			default:
				$articles = NewsArticle::get()
					->filter(array(
						"ParentID"=>$data->ID))
					->sort('DateAuthored', 'DESC');
		}
		$hit = new PaginatedList($articles, $request);
		$hit->setPageLength($pageSize);
		
		return $hit;
	}
	
	// News Archives
	public function getNewsArchive() {
		return GroupedList::create(NewsArticle::get()
			->filter(array('ParentID'=>$this->Data()->ID))
			->sort('DateAuthored', 'DESC'));
	}

}