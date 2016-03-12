<?php

/**
 * Class CollectionPage
 */
class CollectionPage extends Page implements PermissionProvider
{

    /**
     * @var string
     */
    private static $managed_detail = 'DetailPage';
    /**
     * @var int
     */
    private static $page_size = 10;

    /**
     * tag list for sidebar
     *
     * @return bool|DataList
     */
    public function getTags()
    {

        $hit = Tag::get()
            ->filter(array(
                'Pages.ID:GreaterThan' => 0,
                'Pages.ID.ParentID' => $this->ID
            ))
            ->sort('Title', 'DESC');
        if ($hit->Count() == 0) {
            $hit = false;
        }
        return $hit;
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
        return Permission::check('CollectionPage_CRUD');
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('CollectionPage_CRUD');
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null)
    {
        return Permission::check('CollectionPage_CRUD');
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'CollectionPage_CRUD' => 'Create, Update and Delete a Collection Page'
        );
    }

}

/**
 * Class CollectionPage_Controller
 */
class CollectionPage_Controller extends Page_Controller
{

    /**
     * @var array
     */
    private static $allowed_actions = array(
        'index',
        'AdvSearchForm',
        'tag',
    );

    /**
     * @return string
     */
    protected function getManagingClass()
    {
        return $this->data()->ClassName;
    }

    /**
     * @return array|scalar
     */
    protected function getManagedClass()
    {
        return Config::inst()->get($this->getManagingClass(), 'managed_detail');
    }

    /**
     * @param SS_HTTPRequest $request
     * @return PaginatedList
     */
    public function index(SS_HTTPRequest $request)
    {


        $listClass = $this->getManagedClass();

        $start = ($request->getVar('start')) ? (int)$request->getVar('start') : 0;

        $limit = Config::inst()->get($this->getManagingClass(), 'page_size');

        $context = (method_exists($listClass, 'getCustomSearchContext'))
            ? singleton($listClass)->getCustomSearchContext()
            : singleton($listClass)->getDefaultSearchContext();

        $list = $context->getResults($request->requestVars());

        $results = PaginatedList::create($list, $this->request);
        $results->setPageStart($start);
        $results->setPageLength($limit);

        return $this->customise(array(
            'Results' => $results
        ));
    }

    /**
     * Search Objects
     *
     * @return mixed
     */
    public function AdvSearchForm()
    {

        $searchObject = $this->getManagedClass();

        $context = (method_exists($searchObject, 'getCustomSearchContext'))
            ? singleton($searchObject)->getCustomSearchContext()
            : singleton($searchObject)->getDefaultSearchContext();
        $fields = $context->getSearchFields();

        $actions = new FieldList(
            new FormAction('search', 'Search')
        );

        $form = Form::create($this, "AdvSearchForm",
            $fields,
            $actions
        );

        $form
            ->setFormMethod('get')
            ->disableSecurityToken()
            ->setFormAction($this->Link());

        return $form;
    }

    /**
     * @param SS_HTTPRequest $request
     * @return ViewableData_Customised
     */
    public function tag(SS_HTTPRequest $request)
    {

        if ($request->param('ID') && $tag = Convert::raw2sql($request->param('ID'))) {

            $start = ($request->getVar('start')) ? (int)$request->getVar('start') : 0;

            $items = DetailPage::get()
                ->filter(array(
                    'ParentID' => $this->ID,
                    'Tags.Title' => $tag
                ));

            $list = PaginatedList::create($items, $this->request);
            $list->setPageStart($start);
            $list->setPageLength(Config::inst()->get($this->getManagingClass(), 'page_size'));

        } else {
            $list = false;
        }

        return $this->customise(array(
            'Filter' => 'Items tagged with "' . $request->param('ID') . '"',
            'Items' => $list
        ));

    }

}