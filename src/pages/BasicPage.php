<?php

namespace Dynamic\Core\Page;

use DetailPage;
use PermissionProvider;
use Permission;
use DetailPage_Controller;


class BasicPage extends DetailPage implements PermissionProvider
{
    /**
     * @var string
     */
    private static $singular_name = "Basic Page";

    /**
     * @var string
     */
    private static $plural_name = "Basic Pages";

    /**
     * @var string
     */
    private static $description = "Rich content page, includes large image area";


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
        return Permission::check('Basic_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('Basic_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null)
    {
        return Permission::check('Basic_CRUD', 'any', $member);
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'Basic_CRUD' => 'Create, Update and Delete a Basic Page'
        );
    }
}

class BasicPage_Controller extends DetailPage_Controller
{

}
