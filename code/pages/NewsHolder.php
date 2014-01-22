<?php

class NewsHolder extends HolderPage {

	private static $singular_name = "News Holder";
	private static $plural_name = "News Holders";
	private static $description = "Displays list of News Articles";

	// used by Items method in HolderPage
	public static $item_class = 'NewsArticle';

	private static $allowed_children = array('NewsArticle');
	private static $default_child = 'NewsArticle';

	private static $hide_ancestor = "HolderPage";

	// News Archives
	public function getNewsArchive() {
		return GroupedList::create(NewsArticle::get()
			->filter(array(
				'ParentID'=>$this->Data()->ID,
				'DateAuthored:LessThan' => SS_Datetime::now()->Format('Y-m-d')))
			->sort('DateAuthored', 'DESC'));
	}

	public static function getRecentNews($limit = 10){
		$news = NewsArticle::get()
			->limit($limit)
			->sort(array('DateAuthored'=>'DESC'));

		return $news;
	}

	public function getItemsShort(){
		return NewsArticle::get()
			->limit(3)
			->sort(array('DateAuthored' => 'DESC'))
			->filter(array('ParentID' => $this->ID));
	}

}

class NewsHolder_Controller extends HolderPage_Controller {

	private static $allowed_actions = array(
		'tag',
		'archive',
		'rss'
	);

	public function archive($request = null){
		$params = $request->allParams();

		$filter = array();

		if($year = $params['ID']){
			if($month = $params['OtherID']){
				$start = $year."-".$month;
				$monthWord = date('F', strtotime($start));
				$end = date('Y-m-d', strtotime("last day of $monthWord"));
			}else{
				$start = "$year-01-01";
				$end = "$year-12-31";
			}
			$from = SS_Datetime::create();
			$from->setValue($start);
			$to = SS_Datetime::create();
			$to->setValue($end);

			$filter = array(
				'ParentID' => $this->Data()->ID,
				'DateAuthored:GreaterThan' => $from->value,
				'DateAuthored:LessThan' => $to->value);

			return $this->customise(array(
				'Items' => NewsArticle::get()
				->filter($filter)
				->sort('DateAuthored', 'DESC')));
		}

		$message = "Please use a valid archive url (i.e. ".$this->Link('archive')."/2013/ for a year or ".$this->Link('archive')."/2013/07/ for a year/month";

		return $this->customise(array(
			'Items' =>false,
			'Message' => $message));
	}

}