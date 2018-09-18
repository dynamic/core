<?php

namespace Dynamic\Core\Page;

use SectionPage;
use PermissionProvider;
use Permission;
use SectionPage_Controller;


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
        return Permission::check('DynamicHomePage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('DynamicHomePage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null)
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
