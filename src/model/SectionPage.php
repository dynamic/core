<?php

namespace Dynamic\Core\Model;

use Page;
use PermissionProvider;
use Permission;
use Page_Controller;


class SectionPage extends Page implements PermissionProvider
{
    /**
     * @var string
     */
    private static $singluar_name = "Section Page";

    /**
     * @var string
     */
    private static $plural_name = "Section Pages";

    /**
     * @var string
     */
    private static $description = "Section Landing Page, uses Flexslider and Spiffs";

    /**
     * @var string
     */
    private static $hide_ancestor = "SectionPage";

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
        return Permission::check('SectionPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('SectionPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null)
    {
        return Permission::check('SectionPage_CRUD', 'any', $member);
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'SectionPage_CRUD' => 'Create, Update and Delete a Section Page'
        );
    }
}

class SectionPage_Controller extends Page_Controller
{
}
