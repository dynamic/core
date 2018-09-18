<?php

namespace Dynamic\Core\Page;

use Page;
use PermissionProvider;
use Permission;
use Page_Controller;


class SearchPage extends Page implements PermissionProvider
{
    /**
     * @var string
     */
    private static $singular_name = 'Search Page';

    /**
     * @var string
     */
    private static $plural_name = 'Search Pages';

    /**
     * @var string
     */
    private static $description = 'Website search. Searches Title and Content field of each page.';

    /**
     * @var array
     */
    private static $defaults = array(
        'ShowInMenus' => 0,
    );

    /**
     * @param Member $member
     *
     * @return bool
     */
    public function canView($member = null)
    {
        return true;
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canEdit($member = null)
    {
        return Permission::check('SearchPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('SearchPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null)
    {
        if (self::get()->first()) {
            return false;
        }

        return Permission::check('SearchPage_CRUD', 'any', $member);
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'SearchPage_CRUD' => 'Create, Update and Delete a Search Page',
        );
    }
}

class SearchPage_Controller extends Page_Controller
{
    /**
     * @var array
     */
    private static $allowed_actions = array(
        'SearchForm',
    );

    /**
     * @return mixed
     */
    public function SearchForm()
    {
        return parent::SearchForm();
    }
}
