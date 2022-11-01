<?php

namespace Dynamic\Core\Page;

use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

class TextPage extends \Page implements PermissionProvider
{
    /**
     * @var string
     */
    private static $singular_name = 'Text Page';

    /**
     * @var string
     */
    private static $plural_name = 'Text Pages';

    /**
     * @var string
     */
    private static $description = 'This page type provides a basic 1 column page supporting the content allowed in 
        the main content zone of the CMS. This page type is primarily used for legal, privates, etc. pages on a site.';

    /**
     * @var array
     */
    private static $defaults = array(
        'ShowInMenus' => 0);

    /**
     * @var string
     */
    private static $table_name = 'TextPage';

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
        return Permission::check('TextPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('TextPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        if (SiteMap::get()->first()) {
            return false;
        }

        if ($canCreate = Permission::check('TextPage_CRUD', 'any', $member)) {
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
            'TextPage_CRUD' => 'Create, Update and Delete a Text Page'
        );
    }
}
