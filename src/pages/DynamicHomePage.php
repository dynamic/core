<?php

namespace Dynamic\Core\Page;

use Dynamic\Core\Model\SectionPage;
use Dynamic\Core\Model\SectionPage_Controller;
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
        return Permission::check('DynamicHomePage_CRUD', 'any', $member);
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

class DynamicHomePage_Controller extends SectionPage_Controller
{
}
