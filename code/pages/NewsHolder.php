<?php

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
    public static $item_class = 'NewsArticle';

    /**
     * @var array
     */
    private static $allowed_children = array('NewsArticle');

    /**
     * @var string
     */
    private static $default_child = 'NewsArticle';

    /**
     * @var string
     */
    private static $hide_ancestor = "HolderPage";

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
                'DateAuthored:LessThan' => SS_Datetime::now()->Format('Y-m-d')))
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
        return Permission::check('NewsHolderPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('NewsHolderPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null)
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

class NewsHolder_Controller extends HolderPage_Controller
{
    /**
     * @var array
     */
    private static $allowed_actions = array(
        'tag',
        'archive',
        'rss'
    );

    /**
     * @param null $request
     * @return ViewableData_Customised
     */
    public function archive($request = null)
    {
        $params = $request->allParams();

        if ($year = $params['ID']) {
            if ($month = $params['OtherID']) {
                $start = $year."-".$month;
                $monthWord = date('F', strtotime($start));
                $end = date('Y-m-d', strtotime("last day of $monthWord $year"));
            } else {
                $start = "$year-01-01";
                $end = "$year-12-31";
            }
            $from = SS_Datetime::create();
            $from->setValue($start);
            $to = SS_Datetime::create();
            $to->setValue($end);

            $filter = array(
                'ParentID' => $this->data()->ID,
                'DateAuthored:GreaterThan' => $from->value,
                'DateAuthored:LessThanOrEqual' => $to->value,
            );

            return $this->customise(array(
                'Items' => NewsArticle::get()
                ->filter($filter)
                ->sort('DateAuthored', 'DESC')));
        }

        $message = "Please use a valid archive url (i.e. ".$this->Link('archive')."/2013/ for a year or ".$this->Link('archive')."/2013/07/ for a year/month";

        return $this->customise(array(
            'Items' =>false,
            'Message' => $message));
    }
}
