<?php

namespace Dynamic\Core\Page;

use Dynamic\Core\Page\NewsHolder;
use Dynamic\Core\Page\HolderItem;
use SilverStripe\Forms\DatetimeField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\FieldType\DBDatetime;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

class NewsArticle extends HolderItem implements PermissionProvider
{
    /**
     * @var string
     */
    private static $singular_name = 'News Article';

    /**
     * @var string
     */
    private static $plural_name = 'News Articles';

    /**
     * @var string
     */
    private static $description = 'Article for the News section';

    /**
     * @var string
     */
    public static $listing_page_class = NewsHolder::class;

    /**
     * @var string
     */
    private static $default_parent = NewsHolder::class;

    /**
     * @var bool
     */
    private static $can_be_root = false;

    /**
     * @var string
     */
    private static $hide_ancestor = HolderItem::class;

    /**
     * @var string
     */
    private static $table_name = 'NewsArticle';

    /**
     * @var array
     */
    private static $db = array(
        'DateAuthored' => 'DBDatetime',
        'Author' => 'Varchar(255)',
        'Featured' => 'Boolean'
    );

    /**
     * @var array
     */
    private static $defaults = array(
        'ShowInMenus' => 0
    );

    /**
     * @var array
     */
    private static $default_sort = array(
        'DateAuthored' => 'DESC'
    );


    /**
     * Add the default for the Date being the current day.
     */
    public function populateDefaults()
    {
        parent::populateDefaults();

        if (!isset($this->DateAuthored) || $this->DateAuthored === null) {
            $this->DateAuthored = DBDatetime::now();
        }
    }

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->addFieldToTab('Root.Main', TextField::create('Author'), 'Content');
            $fields->addFieldToTab('Root.Main', $dateTimeField = new DatetimeField('DateAuthored'), 'Content');
        });

        return parent::getCMSFields();
    }

    /***
     * @return bool|string
     */
    public function getMonthCreated()
    {
        return ($this->DateAuthored) ? date('F Y', strtotime($this->DateAuthored)) : false;
    }

    /***
     * @return bool|string
     */
    public function getYearCreated()
    {
        return ($this->DateAuthored) ? date('Y', strtotime($this->DateAuthored)) : false;
    }

    /**
     * @return HTMLText
     */
    public function getSummary()
    {
        return $this->renderWith('NewsSummary', 'DetailListSummary');
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
        return Permission::check('News_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('News_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        if ($canCreate = Permission::check('News_CRUD', 'any', $member)) {
            return parent::canCreate($member, $context);
        }

        return false;
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'News_CRUD' => 'Create, Update and Delete a News Article'
        );
    }
}
