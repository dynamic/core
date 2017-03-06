<?php

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
        return Permission::check('LandingPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('LandingPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null)
    {
        return Permission::check('LandingPage_CRUD', 'any', $member);
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

class LandingPage_Controller extends SectionPage_Controller
{
}
