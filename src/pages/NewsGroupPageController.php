<?php

namespace Dynamic\Core\Page;

use Dynamic\Core\Model\HolderPageController;
use SilverStripe\ORM\PaginatedList;

class NewsGroupPageController extends HolderPageController
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
