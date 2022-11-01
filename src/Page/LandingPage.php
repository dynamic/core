<?php

namespace Dynamic\Core\Page;

use Dynamic\Core\Page\SectionPage;
use Dynamic\Core\Page\SectionPage_Controller;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

class LandingPage extends SectionPage implements PermissionProvider
{
    /**
     * @var string
     */
    private static $singluar_name = "Landing Page";

    /**
     * @var string
     */
    private static $plural_name = "Landing Pages";

    /**
     * @var string
     */
    private static $description = 'Section Landing Page, displays list of subpages';

    /**
     * @var string
     */
    private static $table_name = 'LandingPage';

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
        return Permission::check('LandingPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('LandingPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        if ($canCreate = Permission::check('LandingPage_CRUD', 'any', $member)) {
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
            'LandingPage_CRUD' => 'Create, Update and Delete a Landing Page'
        );
    }
}
