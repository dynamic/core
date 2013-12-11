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
			return $controller->Data()->Parent()->URLSegment."/tag/".$this->Title;
		} else {
			return $controller->join_links($controller->Link('tag'),$this->Title);
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

}