<?php

namespace Dynamic\Core\Page;

use Dynamic\Core\Page\DetailPage;
use Dynamic\Core\Model\Tag;
use SilverStripe\Core\Convert;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

class CollectionPage extends \Page implements PermissionProvider
{
    /**
     * @var string
     */
    private static $singular_name = "Collection Page";

    /**
     * @var string
     */
    private static $plural_name = "Collection Pages";

    /**
     * @var string
     */
    private static $description = "Displays a searchable, paginated list of content";

    /**
     * @var string
     */
    private static $hide_ancestor = CollectionPage::class;

    /**
     * @var array
     */
    private static $allowed_children = [DetailPage::class];

    /**
     * @var string
     */
    private static $default_child = DetailPage::class;

    /**
     * @var string
     */
    private static $managed_detail = DetailPage::class;

    /**
     * @var int
     */
    private static $page_size = 10;

    /**
     * @var string
     */
    private static $table_name = 'CollectionPage';

    /**
     * @return string
     */
    public static function getManagedDetail()
    {
        return self::$managed_detail;
    }

    /**
     * @return int
     */
    public static function getPageSize()
    {
        return self::$page_size;
    }

    /**
     * tag list for sidebar
     *
     * @return bool|DataList
     */
    public function getTags()
    {
        $hit = Tag::get()
            ->filter(array(
                'Pages.ID:GreaterThan'=>0,
                'Pages.ID.ParentID' => $this->ID))
            ->sort('Title', 'DESC');
        if ($hit->Count()==0) {
            $hit = false;
        }
        return $hit;
    }

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
        return Permission::check('CollectionPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('CollectionPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        return Permission::check('CollectionPage_CRUD', 'any', $member);
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            //'Location_VIEW' => 'Read a Location',
            'CollectionPage_CRUD' => 'Create, Update and Delete a Collection Page'
        );
    }
}
