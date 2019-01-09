<?php

namespace Dynamic\Core\Page;

use SilverStripe\Control\RSS\RSSFeed;
use SilverStripe\ORM\PaginatedList;

class HolderPageController extends \PageController
{
    /**
     *
     */
    public function init()
    {
        RSSFeed::linkToFeed($this->Link('rss') . '.xml', $this->Data()->Title.' rss feed');
        parent::init();
    }

    /**
     * @var array
     */
    private static $allowed_actions = array(
        'tag',
        'rss'
    );

    /**
     * @param array $filter
     * @param int $pageSize
     * @return static
     */
    public function Items($filter = array(), $pageSize = 10)
    {
        $filter['ParentID'] = $this->Data()->ID;
        $class =  $this->Data()->stat('item_class');

        // get all records from $class using $filter
        $items = $class::get()->filter($filter);

        $list = PaginatedList::create($items, $this->request);
        $list->setPageLength($pageSize);

        return $list;
    }

    /**
     * @return HolderPage_Controller|ViewableData_Customised
     */
    public function tag()
    {
        $request = $this->request;
        $params = $request->allParams();

        if ($tag = Convert::raw2sql(urldecode($params['ID']))) {
            $filter = array('Tags.Title' => $tag);

            return $this->customise(array(
                'Message' => 'showing entries tagged "' . $tag . '"',
                'Items' => $this->Items($filter)
            ));
        }

        return $this->Items();
    }

    /**
     * @return HTMLText
     */
    public function rss()
    {
        $title = $this->Data()->Title;
        $description = "$title rss feed";
        $rss = new RSSFeed(
            $this->Items(),
            $this->Link('rss'),
            $this->Data()->Title,
            $description
        );
        return $rss->outputToBrowser();
    }
}
