<?php

namespace Dynamic\Core\Page;

use Dynamic\Core\Page\NewsHolder;
use Dynamic\Core\Page\HolderPage;
use Nette\Utils\ArrayList;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

class NewsGroupPage extends HolderPage implements PermissionProvider
{
    /**
     * @var string
     */
    private static $singular_name = "News and Events";

    /**
     * @var string
     */
    private static $plural_name = 'News and Events';

    /**
     * @var string
     */
    private static $description = 'Page holding News Holder and Event Holder pages';

    /**
     * @var array
     */
    private static $allowed_children = array(NewsHolder::class);

    /**
     * @var array
     */
    private static $item_class = array(NewsHolder::class);

    /**
     * @var string
     */
    private static $table_name = 'NewsGroupPage';

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
        return Permission::check('NewsGroupPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('NewsGroupPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        if ($canCreate = Permission::check('NewsGroupPage_CRUD', 'any', $member)) {
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
            'NewsGroupPage_CRUD' => 'Create, Update and Delete a News Group Page'
        );
    }
}
