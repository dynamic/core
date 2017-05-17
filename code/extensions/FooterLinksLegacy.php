<?php

class FooterLinksLegacy extends DataExtension
{
    private static $many_many = array(
        'FooterLinks' => 'SiteTree'
    );

    private static $many_many_extraFields = array(
        'FooterLinks' => array(
            'SortOrder' => 'Int'
        )
    );

    public function updateCMSFields(FieldList $fields)
    {
        $config = GridFieldConfig_RelationEditor::create();
        if (class_exists('GridFieldSortableRows')) {
            $config->addComponent(new GridFieldSortableRows("SortOrder"));
        }

        $FooterGridField = GridField::create("FooterLinks", "Footer Links", $this->owner->FooterLinks()->sort('SortOrder'), $config);

        $fields->addFieldsToTab("Root.Footer", array(
            $FooterGridField
        ));
    }
}