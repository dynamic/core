<?php

namespace Dynamic\Core\ORM;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\ORM\DataExtension;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

class FooterLinksLegacy extends DataExtension
{
    /**
     * @var array
     */
    private static $many_many = array(
        'FooterLinks' => 'SiteTree'
    );

    /**
     * @var array
     */
    private static $many_many_extraFields = array(
        'FooterLinks' => array(
            'SortOrder' => 'Int'
        )
    );

    /**
     * @param FieldList $fields
     */
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

    /**
     * @return mixed
     */
    public function getFooterLinkList()
    {
        return $this->owner->FooterLinks()->sort('SortOrder');
    }
}
