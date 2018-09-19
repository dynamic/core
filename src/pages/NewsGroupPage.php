<?php

namespace Dynamic\Core\Page;

use Dynamic\Core\Page\NewsHolder;
use Dynamic\Core\Model\HolderPage;
use Dynamic\Core\Model\HolderPage_Controller;
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
        return Permission::check('NewsGroupPage_CRUD', 'any', $member);
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

class NewsGroupPage_Controller extends HolderPage_Controller
{
    /**
     * @param array $filter
     * @param int $pageSize
     * @return PaginatedList
     */
    public function Items($filter = array(), $pageSize = 10)
    {
        $filter['ParentID'] = $this->Data()->ID;
        $class =  $this->Data()->stat('item_class');

        if (is_array($class)) {
            $items = ArrayList::create();
            foreach ($class as $cl) {
                $sub = $cl::get()->filter($filter);
                if ($sub->count()>1) {
                    foreach ($sub as $item) {
                        $items->push($item);
                    }
                } else {
                    $items->push($sub->first());
                }
            }
        } else {
            $items = $class::get()->filter($filter);
        }

        $list = PaginatedList::create($items, $this->request);
        $list->setPageLength($pageSize);

        return $list;
    }
}
