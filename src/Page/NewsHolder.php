<?php

namespace Dynamic\Core\Page;

use Dynamic\Core\Page\NewsArticle;
use Dynamic\Core\Page\HolderPage;
use SilverStripe\ORM\FieldType\DBDatetime;
use SilverStripe\ORM\GroupedList;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

class NewsHolder extends HolderPage implements PermissionProvider
{
    /**
     * @var string
     */
    private static $singular_name = "News Landing Page";

    /**
     * @var string
     */
    private static $plural_name = "News Landing Pages";

    /**
     * @var string
     */
    private static $description = "Displays list of News Articles";

    /**
     * used by Items method in HolderPage
     *
     * @var string
     */
    private static $item_class = NewsArticle::class;

    /**
     * @var array
     */
    private static $allowed_children = array(NewsArticle::class);

    /**
     * @var string
     */
    private static $default_child = NewsArticle::class;

    /**
     * @var string
     */
    private static $hide_ancestor = HolderPage::class;

    /**
     * @var string
     */
    private static $table_name = 'NewsHolder';

    /**
     * News Archives
     *
     * @return GroupedList
     */
    public function getNewsArchive()
    {
        return GroupedList::create(NewsArticle::get()
            ->filter(array(
                'ParentID'=>$this->Data()->ID,
                'DateAuthored:LessThan' => DBDatetime::now()->Format('Y-m-d')))
            ->sort('DateAuthored', 'DESC'));
    }

    /**
     * @param int $limit
     * @return DataList
     */
    public static function getRecentNews($limit = 10)
    {
        $news = NewsArticle::get()
            ->limit($limit)
            ->sort(array('DateAuthored'=>'DESC'));

        return $news;
    }

    /**
     * @return DataList
     */
    public function getItemsShort()
    {
        return NewsArticle::get()
            ->limit(3)
            ->sort(array('DateAuthored' => 'DESC'))
            ->filter(array('ParentID' => $this->ID));
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
        return Permission::check('NewsHolderPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('NewsHolderPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        return Permission::check('NewsHolderPage_CRUD', 'any', $member);
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'NewsHolderPage_CRUD' => 'Create, Update and Delete a News Holder Page'
        );
    }
}
