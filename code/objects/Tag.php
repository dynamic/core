<?php

class Tag extends DataObject {

    static $db = array(
        'Title' => 'Varchar(200)'
    );

    static $belongs_many_many = array(
        'Pages' => 'Page'
    );
    
    public function getCMSFields() {
	    $fields = parent::getCMSFields();
	    
	    return $fields;
    }
    
    public function getLink() {
		$controller = Controller::curr();
		if($controller->Data()->ClassName=='Page'){
			return $controller->Data()->Parent()->URLSegment."/Tag/".$this->ID;
		}else{
			return $controller->join_links($controller->Link('Tag'),$this->ID);
		}
	}
    
}