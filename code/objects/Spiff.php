<?php

class Spiff extends DataObject
{
    private static $db = array(
        'Name' => 'Varchar(255)',
        'Title' => 'Varchar(255)',
        'Description' => 'HTMLText',
    );

    private static $has_one = array(
        'Image' => 'Image',
        'PageLink' => 'SiteTree',
    );

    private static $belongs_many_many = array(
        'SectionPages' => 'SectionPage',
    );

    private static $default_sort = 'Name ASC';

    private static $summary_fields = array(
        'Image.CMSThumbnail' => 'Image',
        'Name' => 'Title',
    );

    private static $searchable_fields = array(
        'Name' => 'Name',
        'Title' => 'Title',
    );

    public function getCMSFields()
    {
        $ImageField = new UploadField('Image', 'Image');
        $ImageField->getValidator()->allowedExtensions = array('jpg', 'jpeg', 'gif', 'png');
        $ImageField->setFolderName('Uploads/Spiffs');
        $ImageField->setConfig('allowedMaxFileNumber', 1);
        $ImageField->getValidator()->setAllowedMaxFileSize(CORE_IMAGE_FILE_SIZE_LIMIT);

        $fields = parent::getCMSFields();

        $fields->insertBefore($pageLink = TreeDropdownField::create('PageLinkID', 'Link', 'SiteTree'), 'Description');
        $fields->insertBefore($ImageField, 'Description');

        $this->extend('updateCMSFields', $fields);

        return $fields;
    }

    public function validate()
    {
        $result = parent::validate();

        if (!$this->Name) {
            $result->error('Title is requied before you can save');
        }

        return $result;
    }

    public function getHeadline()
    {
        if ($this->Title) return $this->Title;
        return false;
    }

    // return Spiff View
    public function forTemplate()
    {
        return $this->renderWith('SpiffView');
    }

    // Set permissions, allow all users to access in ModelAdmin
    public function canCreate($member = null)
    {
        return true;
    }
    public function canView($member = null)
    {
        return true;
    }
    public function canEdit($member = null)
    {
        return true;
    }
    public function canDelete($member = null)
    {
        return true;
    }
}
