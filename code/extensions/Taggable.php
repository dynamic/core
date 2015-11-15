<?php

class Taggable extends DataExtension
{
    private static $many_many = array(
        'Tags' => 'Tag',
    );

    public function updateCMSFields(FieldList $fields)
    {
        // Tag Field
        $TagField = TagField::create('Tags', null, Tag::get(), $this->owner->Tags());
        $TagField->setCanCreate(true);
        $fields->addFieldToTab('Root.Main', $TagField, 'Content');
    }
}
