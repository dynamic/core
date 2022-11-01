<?php

namespace Dynamic\Core\Page;

use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

class SearchPage extends \Page implements PermissionProvider
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
     * @var string
     */
    private static $table_name = 'SearchPage';

    /**
     * @param Member $member
     *
     * @return bool
     */
    public function canView($member = null, $context = [])
    {
        return true;
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canEdit($member = null, $context = [])
    {
        return Permission::check('SearchPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('SearchPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        if (self::get()->first()) {
            return false;
        }

        if ($canCreate = Permission::check('SearchPage_CRUD', 'any', $member)) {
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
            'SearchPage_CRUD' => 'Create, Update and Delete a Search Page',
        );
    }
}
