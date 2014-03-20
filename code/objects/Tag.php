<?php

class Tag extends DataObject {

    private static $db = array(
        'Title' => 'Varchar(200)'
    );

    private static $belongs_many_many = array(
        'Pages' => 'DetailPage'
    );

    public function getCMSFields() {
	    $fields = parent::getCMSFields();

	    return $fields;
    }

    public function getLink() {
		$controller = Controller::curr();
		$class = $controller->Data()->ClassName;

		if($class == 'DetailPage' || is_subclass_of($class, 'DetailPage')) {
			if($controller->Data()->Parent()->Parent()){
				return $controller->Data()->Parent()->Parent()->URLSegment.'/'.$controller->Data()->Parent()->URLSegment.'/tag/'.urlencode($this->Title);
			}else{
				return $controller->Data()->Parent()->URLSegment."/tag/".urlencode($this->Title);
			}
		} else {
			return $controller->join_links($controller->Link('tag'),urlencode($this->Title));
		}

	}

	public function getRelatedPages(){

		$controller = Controller::curr();
		$class = $controller->Data()->ClassName;

		if($class == 'DetailPage' || is_subclass_of($class, 'DetailPage')) {
			$parentID = $controller->Data()->Parent()->ID;
		} else {
			$parentID = $controller->Data()->ID;
		}

		$pages = DetailPage::get()
			->filter(array('Tags.ID'=>$this->ID,'ParentID'=>$parentID));

		return $pages->Count();

	}

	public function CurrentLevel() {
		$page = $this;
		$level = 1;
		while(1){
			if($page->Parent){
				$level++;
				$page = $page->Parent();
			}else{
				return $level;
			}
		}
	}

}