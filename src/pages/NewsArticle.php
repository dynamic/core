<?php

namespace Dynamic\Core\Page;

use HolderItem;
use PermissionProvider;
use SS_Datetime;
use TextField;
use DatetimeField;
use Permission;
use HolderItem_Controller;


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
    public static $listing_page_class = 'NewsHolder';

    /**
     * @var string
     */
    private static $default_parent = 'NewsHolder';

    /**
     * @var bool
     */
    private static $can_be_root = false;

    /**
     * @var string
     */
    private static $hide_ancestor = "HolderItem";

    /**
     * @var array
     */
    private static $db = array(
        'DateAuthored' => 'SS_Datetime',
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
            $this->DateAuthored = SS_Datetime::now()->Format('Y-m-d H:i:s');
        }
    }

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', TextField::create('Author'), 'Content');
        $fields->addFieldToTab('Root.Main', $dateTimeField = new DatetimeField('DateAuthored'), 'Content');
        $dateTimeField->getDateField()->setConfig('showcalendar', true);

        return $fields;
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
        return Permission::check('News_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('News_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null)
    {
        return Permission::check('News_CRUD', 'any', $member);
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

class NewsArticle_Controller extends HolderItem_Controller
{
}
