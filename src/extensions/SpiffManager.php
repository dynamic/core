<?php

namespace Dynamic\Core\ORM;

use Dynamic\Core\Object\Spiff;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\ORM\DataExtension;
use Symbiote\GridFieldExtensions\GridFieldAddExistingSearchButton;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

class SpiffManager extends DataExtension
{
    private static $many_many = array(
        'Spiffs' => Spiff::class,
    );

    private static $many_many_extraFields = array(
        'Spiffs' => array(
            'SortOrder' => 'Int',
        )
    );

    public function getSpiffList()
    {
        return $this->owner->Spiffs()->sort('SortOrder');
    }

    public function updateCMSFields(FieldList $fields)
    {
        $config = GridFieldConfig_RelationEditor::create();
        if (class_exists('GridFieldSortableRows')) {
            $config->addComponent(new GridFieldSortableRows('SortOrder'));
        }
        if (class_exists('GridFieldAddExistingSearchButton')) {
            $config->removeComponentsByType('GridFieldAddExistingAutocompleter');
            $config->addComponent(new GridFieldAddExistingSearchButton());
        }
        $spiffs = $this->owner->Spiffs()
            ->filter(array('ClassName' => Spiff::class))
            ->sort('SortOrder')
        ;
        $SpiffGridField = GridField::create('Spiffs', 'Spiffs', $spiffs, $config);

        // add Spiff grid field if record exists
        if ($this->owner->exists()) {
            $fields->addFieldsToTab('Root.Spiffs', array(
                $SpiffGridField,
            ));
        }
    }
}
