<?php

class LinksList extends DataExtension
{
    private static $many_many = array(
        'Links' => 'LinkObject',
    );

    private static $many_many_extraFields = array(
        'Links' => array(
            'SortOrder' => 'Int',
        ),
    );

    public function updateCMSFields(FieldList $fields)
    {
        // Links
        $config = GridFieldConfig_RelationEditor::create();
        if (class_exists('GridFieldSortableRows')) {
            $config->addComponent(new GridFieldSortableRows('SortOrder'));
        }
        if (class_exists('GridFieldAddExistingSearchButton')) {
            $config->removeComponentsByType('GridFieldAddExistingAutocompleter');
            $config->addComponent(new GridFieldAddExistingSearchButton());
        }
        $LinksField = GridField::create('Links', 'Links', $this->owner->Links()->sort('SortOrder'), $config);

        $fields->addFieldsToTab('Root.SideBar', array(
            $LinksField,
        ));
    }
}
