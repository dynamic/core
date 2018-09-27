<?php

namespace Dynamic\Core\Page;

use Dynamic\Core\Model\Spiff;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

class SectionPage extends \Page implements PermissionProvider
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
     * @var array
     */
    private static $many_many = [
        'Spiffs' => Spiff::class,
    ];

    /**
     * @var string
     */
    private static $hide_ancestor = SectionPage::class;

    /**
     * @var string
     */
    private static $table_name = 'SectionPage';

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
        return Permission::check('SectionPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('SectionPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
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
