<?php

namespace Dynamic\Core\Page;

use Dynamic\Core\Page\SectionPage;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

class DynamicHomePage extends SectionPage implements PermissionProvider
{
    /**
     * @var string
     */
    private static $singular_name = "Home Page";

    /**
     * @var string
     */
    private static $plural_name = "Home Pages";

    /**
     * @var string
     */
    private static $description = 'Website homepage, includes slides and spiffs';

    /**
     * @var string
     */
    private static $table_name = 'DynamicHomePage';

    /**
     * @var array
     */
    private static $defaults = array(
        'ShowInMenus' => 0
    );

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
        return Permission::check('DynamicHomePage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('DynamicHomePage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        if (DynamicHomePage::get()->first()) {
            return false;
        }

        if ($canCreate = Permission::check('DynamicHomePage_CRUD', 'any', $member)) {
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
            'DynamicHomePage_CRUD' => 'Create, Update and Delete a Home Page'
        );
    }
}
