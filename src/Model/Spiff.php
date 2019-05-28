<?php

namespace Dynamic\Core\Model;

use Dynamic\Core\Page\SectionPage;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataObject;

class Spiff extends DataObject
{
    private static $db = array(
        'Name' => 'Varchar(255)',
        'Title' => 'Varchar(255)',
        'Description' => 'HTMLText',
    );

    private static $has_one = array(
        'Image' => Image::class,
        'PageLink' => SiteTree::class,
    );

    private static $belongs_many_many = array(
        'SectionPages' => SectionPage::class,
    );

    private static $default_sort = 'Name ASC';

    private static $summary_fields = array(
        'Image.CMSThumbnail' => 'Image',
        'Name' => 'Name',
        'Title' => 'Title',
    );

    /*
    private static $searchable_fields = array(
        'Name' => 'Name',
        'Title' => 'Title',
    );
    */

    private static $table_name = 'Spiff';

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {
            $fields->insertBefore(
                TreeDropdownField::create('PageLinkID', 'Link', SiteTree::class),
                'Description'
            );
        });

        $fields = parent::getCMSFields();

        $ImageField = new UploadField('Image', 'Image');
        $ImageField->getValidator()->allowedExtensions = array('jpg', 'jpeg', 'gif', 'png');
        $ImageField->setFolderName('Uploads/Spiffs');
        $ImageField->getValidator()->setAllowedMaxFileSize(CORE_IMAGE_FILE_SIZE_LIMIT);
        $fields->insertBefore($ImageField, 'Description');

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

    // return Spiff View
    public function forTemplate()
    {
        return $this->renderWith('SpiffView');
    }

    // Set permissions, allow all users to access in ModelAdmin
    public function canCreate($member = null, $context = [])
    {
        return true;
    }
    public function canView($member = null, $context = [])
    {
        return true;
    }
    public function canEdit($member = null, $context = [])
    {
        return true;
    }
    public function canDelete($member = null, $context = [])
    {
        return true;
    }
}
