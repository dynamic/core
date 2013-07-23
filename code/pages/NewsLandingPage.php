<?php

class NewsLandingPage extends Page {

	static $singular_name = "News Page";
	static $plural_name = "News Pages";
	static $description = "News Landing Page";

	static $allowed_children = array('NewsArticle');
	static $default_child = 'NewsArticle';

	// exclude child pages from Menu
	public function MenuChildren() {
		return parent::MenuChildren()->exclude('ClassName', 'NewsArticle');
	}

	public function getCategories() {
		
		$hit = NewsCategory::get()
			->filter(array(
				'NewsItems.ID:GreaterThan'=>0,
				'NewsItems.ID.ParentID' => $this->ID))
			->sort('Title', 'DESC');
		if($hit->Count()==0){
			$hit = false;
		}
		return $hit;
	}
	
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

	public function getDefaultRSSLink() {
		return $this->Link('rss');
	}

	public function getArticles(){
		$articles = NewsArticle::get()
			->filter(array('ParentID' => $this->ID))->sort('Date','DESC')->limit(2);
		return $articles;
	}

}

class NewsLandingPage_Controller extends Page_Controller {

	public function init() {
		RSSFeed::linkToFeed($this->Link('rss'), $this->Data()->Title.' news feed');
		parent::init();
	}
	
	private static $allowed_actions = array(
		'Category',
		'Tag',
		'Archive',
		'rss'
	);
	
	public function Category(){
		return array();
	}
	
	public function Tag() {
		return array();
	}
	
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
			case 'Category':
				$categoryID = $params['ID'];
				$articles = NewsArticle::get()
					->filter(array(
						'ParentID' => $data->ID,
						'Categories.ID' => $categoryID))
					->sort('DateAuthored', 'DESC');
				if($articles->Count()==0){
					$articles = false;
				}
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

	public function rss() {
		$title = $this->Data()->Title;
		$description = "$title news feed";
		$rss = new RSSFeed(
			$this->getNewsItems(),
			$this->Link('rss'),
			$this->Data()->Title,
			$description);
		return $rss->outputToBrowser();
	}

}