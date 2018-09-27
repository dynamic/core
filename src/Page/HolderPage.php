<?php

namespace Dynamic\Core\Page;

use Page;

use Dynamic\Core\Page\HolderItem;
use Dynamic\Core\Model\Tag;
use SilverStripe\Control\RSS\RSSFeed;
use SilverStripe\Core\Convert;
use SilverStripe\ORM\PaginatedList;

class HolderPage extends \Page
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
    private static $hide_ancestor = HolderPage::class;

    /**
     * @var string
     */
    private static $item_class = HolderItem::class;

    /**
     * @var string
     */
    private static $table_name = 'HolderPage';

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
        return parent::MenuChildren()->exclude('ClassName', HolderItem::class);
    }

    /**
     * @return string
     */
    public function getDefaultRSSLink()
    {
        return $this->Link('rss');
    }
}
