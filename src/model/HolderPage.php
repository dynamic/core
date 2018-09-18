<?php

namespace Dynamic\Core\Model;

use Page;
use Tag;
use Page_Controller;
use RSSFeed;
use PaginatedList;
use Convert;


class HolderPage extends Page
{
    /**
     * @var string
     */
    private static $singular_name = "Group Page";

    /**
     * @var string
     */
    private static $plural_name = "Group Pages";

    /**
     * @var string
     */
    private static $hide_ancestor = "HolderPage";

    /**
     * @var string
     */
    private static $item_class = 'HolderItem';

    /**
     * tag list for sidebar
     *
     * @return bool|DataList|SS_Limitable
     */
    public function getTags()
    {
        $hit = Tag::get()
            ->filter(array(
                'Pages.ID:GreaterThan'=>0,
                'Pages.ClassName' => $this->stat('item_class'),
                'Pages.ID.ParentID' => $this->ID))
            ->sort('Title')
            ->limit(10);
        if ($hit->Count()==0) {
            $hit = false;
        }
        return $hit;
    }

    /**
     * hide children from menu
     *
     * @return mixed
     */
    public function MenuChildren()
    {
        return parent::MenuChildren()->exclude('ClassName', 'HolderItem');
    }

    /**
     * @return string
     */
    public function getDefaultRSSLink()
    {
        return $this->Link('rss');
    }
}

class HolderPage_Controller extends Page_Controller
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
            $description);
        return $rss->outputToBrowser();
    }
}
