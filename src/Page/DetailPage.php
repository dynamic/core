<?php

namespace Dynamic\Core\Page;

use Dynamic\Core\Model\Tag;
use Dynamic\Core\Model\LinkObject;
use Dynamic\Core\Page\NewsArticle;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;
use SilverStripe\TagField\TagField;
use Symbiote\GridFieldExtensions\GridFieldAddExistingSearchButton;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

class DetailPage extends \Page implements PermissionProvider
{
    /**
     * @var string
     */
    private static $singular_name = "Detail Page";

    /**
     * @var string
     */
    private static $plural_name = "Detail Pages";

    /**
     * @var string
     */
    private static $description = "Rich content page, includes images and slides";

    /**
     * @var array
     */
    private static $has_one = array(
        'Image' => Image::class
    );

    /**
     * @var array
     */
    private static $many_many = array(
        'Tags' => Tag::class,
        'Links' => LinkObject::class
    );

    /**
     * @var array
     */
    private static $many_many_extraFields = array(
        'Links' => array(
            'SortOrder' => 'Int'
        )
    );

    /**
     * @var array
     */
    private static $owns = [
        'Image',
    ];

    /**
     * @var array
     */
    private static $searchable_fields = array(
        'Title',
        'Tags.ID'
    );

    private static $table_name = 'DetailPage';

    /**
     * exclude child pages from Menu
     *
     * @return mixed
     */
    public function MenuChildren()
    {
        return parent::MenuChildren()->exclude('ClassName', NewsArticle::class);
    }

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $ImageField = UploadField::create('Image', 'Main Image');
        $ImageField->getValidator()->allowedExtensions = array('jpg', 'jpeg', 'gif', 'png');
        $ImageField->setFolderName('Uploads/DetailMain');
        //$ImageField->setConfig('allowedMaxFileNumber', 1);
        if ($this->stat('customImageRightTitle')) {
            $ImageField->setRightTitle($this->stat('customImageRightTitle'));
        } else {
            $ImageField->setRightTitle('Large image displayed near the top of the page');
        }

        $fields->addFieldsToTab('Root.Images', array(
            $ImageField
        ));

        if ($this->ID) {
            // Tag Field
            $TagField = TagField::create('Tags', 'Tags', Tag::get(), $this->Tags());
            $TagField->setCanCreate(true);
            $fields->addFieldToTab('Root.Main', $TagField, 'Content');

            // Side Bar Links
            $gridFieldConfig = GridFieldConfig_RelationEditor::create();
            if (class_exists('GridFieldAddExistingSearchButton')) {
                $gridFieldConfig->removeComponentsByType('GridFieldAddExistingAutocompleter');
                $gridFieldConfig->addComponent(new GridFieldAddExistingSearchButton());
            }
            if (class_exists('GridFieldSortableRows')) {
                $gridFieldConfig->addComponent(new GridFieldSortableRows("SortOrder"));
            }
            $LinksField = GridField::create("Links", "Links", $this->Links()->sort('SortOrder'), $gridFieldConfig);

            $fields->addFieldsToTab('Root.SideBar', array(
                $LinksField
            ));
        }

        return $fields;
    }

    /**
     * @return DataList
     */
    public function getPageLinks()
    {
        return $this->Links()->sort('SortOrder');
    }

    /**
     * @param Member $member
     * @return boolean
     */
    public function canView($member = null, $context = [])
    {
        return parent::canView($member = null);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canEdit($member = null, $context = [])
    {
        return Permission::check('DetailPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('DetailPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        return Permission::check('DetailPage_CRUD', 'any', $member);
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'DetailPage_CRUD' => 'Create, Update and Delete a Detail Page'
        );
    }
}
