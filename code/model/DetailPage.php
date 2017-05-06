<?php

class DetailPage extends Page implements PermissionProvider
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
        'Image' => 'Image'
    );

    /**
     * @var array
     */
    private static $many_many = array(
        'Tags' => 'Tag',
        'Links' => 'LinkObject'
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
    private static $searchable_fields = array(
        'Title',
        'Tags.ID'
    );

    /**
     * exclude child pages from Menu
     *
     * @return mixed
     */
    public function MenuChildren()
    {
        return parent::MenuChildren()->exclude('ClassName', 'NewsArticle');
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
        $ImageField->setConfig('allowedMaxFileNumber', 1);
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
    public function canView($member = null)
    {
        return parent::canView($member = null);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canEdit($member = null)
    {
        return Permission::check('DetailPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('DetailPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null)
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

class DetailPage_Controller extends Page_Controller
{

}
