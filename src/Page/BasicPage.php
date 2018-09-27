<?php

namespace Dynamic\Core\Page;

use Dynamic\Core\Page\DetailPage;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

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
     * @var string
     */
    private static $table_name = 'BasicPage';


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
        return Permission::check('Basic_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('Basic_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
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
