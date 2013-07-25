<?php

class Tag extends DataObject {

    static $db = array(
        'Title' => 'Varchar(200)'
    );

    static $belongs_many_many = array(
        'Pages' => 'DetailPage'
    );
    
    public function getCMSFields() {
	    $fields = parent::getCMSFields();
	    
	    return $fields;
    }
    
    public function getLink() {
		$controller = Controller::curr();
		
		//return $controller->Link() . '?Tags__Title=' . $this->getTitle();
		
		
		if($controller->Data()->ClassName=='DetailPage'){
			return $controller->Data()->Parent()->Link() . '?Tags__Title=' . $this->Title;
		}else{
			return $controller->Link() . '?Tags__Title=' . $this->Title;
		}
		
	}
    
}