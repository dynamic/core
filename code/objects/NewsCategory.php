<?php

class NewsCategory extends DataObject {

	static $belongs_many_many = array(
		'NewsItems' => 'NewsArticle'
	);

	static $db = array(
		'Title' => 'Varchar(255)'
	);

	public function getLink() {
		$controller = Controller::curr();
		if($controller->Data()->ClassName=='NewsArticle'){
			return $controller->Data()->Parent()->URLSegment."/Category/".$this->ID;
		}else{
			return $controller->join_links($controller->Link('Category'),$this->ID);
		}
	}

}