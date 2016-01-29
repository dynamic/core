<?php

class SearchPage extends Page implements PermissionProvider
{
    private static $singular_name = 'Search Page';
    private static $plural_name = 'Search Pages';
    private static $description = 'Website search. Searches Title and Content field of each page.';

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
        return parent::canView($member = null);
    }

    public function canEdit($member = null)
    {
        return Permission::check('SearchPage_CRUD');
    }

    public function canDelete($member = null)
    {
        return Permission::check('SearchPage_CRUD');
    }

    public function canCreate($member = null)
    {
        if (self::get()->first()) {
            return false;
        }

        return Permission::check('SearchPage_CRUD');
    }

    public function providePermissions()
    {
        return array(
            //'Location_VIEW' => 'Read a Location',
            'SearchPage_CRUD' => 'Create, Update and Delete a Search Page',
        );
    }
}

class SearchPage_Controller extends Page_Controller
{
    private static $allowed_actions = array(
        'SearchForm',
    );
}
