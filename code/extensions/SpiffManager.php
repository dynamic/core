<?php

class SpiffManager extends DataExtension {
	
	static $many_many = array(
		'Spiffs' => 'Spiff'
	);
	
	public static $many_many_extraFields = array(
		'Spiffs' => array(
			'SortOrder' => 'Int'
		)
	);

	public function getSpiffList() {
		return $this->owner->Spiffs()->sort('SortOrder');
	}
	
	public function updateCMSFields(FieldList $fields) {
		
		$config = GridFieldConfig_RelationEditor::create();	
		//$config->addComponent(new GridFieldBulkEditingTools());
		//$config->addComponent(new GridFieldBulkImageUpload('ImageID', array('Name')));
		if(class_exists('GridFieldManyRelationHandler')){
			$config->addComponent(new GridFieldManyRelationHandler(), 'GridFieldPaginator');
			if(class_exists('GridFieldSortableRows')) {
                $config->addComponent(new GridFieldSortableRows("SortOrder"), 'GridFieldManyRelationHandler');
            }
			$config->removeComponentsByType('GridFieldAddExistingAutocompleter');
		}else{
            if(class_exists('GridFieldSortableRows')) $config->addComponent(new GridFieldSortableRows("SortOrder"));
		}

	    
		$SpiffGridField = GridField::create("Spiffs", "Spiffs", $this->owner->Spiffs()->sort('SortOrder'), $config);
	    	    
	    // add FlexSlider, width and height
	    $fields->addFieldsToTab("Root.Spiffs", array(
	    	$SpiffGridField
	    ));
		
	}
	
	public static function SideBarSpiff(){
		$className = Controller::curr()->Data()->ClassName;
		if($className=='DynamicHomePage'){
			return false;
		}
		return true;
	}

	public function getSpiffs(){
		return $this->owner->getManyManyComponents('Spiffs')->sort('SortOrder');
	}
		
}