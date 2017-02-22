<?php

class CollectionPage extends Page implements PermissionProvider
{

    private static $managed_detail = 'DetailPage';
    private static $page_size = 10;

    public static function getManagedDetail()
    {
        return self::$managed_detail;
    }

    public static function getPageSize()
    {
        return self::$page_size;
    }

    // tag list for sidebar
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
    public function canView($member = null)
    {
        return parent::canView($member = null);
    }

    public function canEdit($member = null)
    {
        return Permission::check('CollectionPage_CRUD');
    }

    public function canDelete($member = null)
    {
        return Permission::check('CollectionPage_CRUD');
    }

    public function canCreate($member = null)
    {
        return Permission::check('CollectionPage_CRUD');
    }

    public function providePermissions()
    {
        return array(
            //'Location_VIEW' => 'Read a Location',
            'CollectionPage_CRUD' => 'Create, Update and Delete a Collection Page'
        );
    }
}

class CollectionPage_Controller extends Page_Controller
{

    private static $allowed_actions = array(
        'tag',
        'AdvSearchForm'
    );

    // get child detail pages of this page
    public function Items($searchCriteria = array())
    {
        $request = ($this->request) ? $this->request : $this->parentController->getRequest();
        if (empty($searchCriteria)) {
            $searchCriteria = $request->requestVars();
        }

        $start = ($request->getVar('start')) ? (int)$request->getVar('start') : 0;
        $limit = 10;//is this used?

        $object = (property_exists($this->Data()->ClassName, 'managed_detail')) ? $this->Data()->stat('managed_detail') : CollectionPage::getManagedDetail();
        $pageSize = (property_exists($this->Data()->ClassName, 'page_size')) ? $this->Data()->stat('page_size') : CollectionPage::getPageSize();
        $context = (method_exists($object, 'getCustomSearchContext')) ? singleton($object)->getCustomSearchContext() : singleton($object)->getDefaultSearchContext();
        $query = $context->getQuery($searchCriteria);
        $records = $context->getResults($searchCriteria);

        $records = PaginatedList::create($records, $this->request);
        $records->setPageStart($start);
        $records->setPageLength($pageSize);

        return $records;
    }

    /**
     * @return mixed
     */
    public function AdvSearchForm()
    {
        $object = $this->getManagedDetail();

        $context = (method_exists($object, 'getCustomSearchContext')) ? singleton($object)->getCustomSearchContext() : singleton($object)->getDefaultSearchContext();
        $fields = $context->getSearchFields();

        $actions = new FieldList(
            new FormAction('search', 'Search')
        );

        $form = Form::create($this, 'AdvSearchForm',
            $fields,
            $actions
        );

        $form->setFormMethod('get');

        return $form;
    }


    // Results filtered by query
    public function search($data, $form, $request)
    {
        $limit = true;
        return $this->render(array(
            'Items' => $this->Items($data),
            'AdvSearchForm' => $form
        ));
    }

    public function tag($pageSize = 10)
    {
        $request = $this->request;
        $params = $request->allParams();

        if ($tag = Convert::raw2sql($params['ID'])) {
            $items = DetailPage::get()
                ->filter(array(
                    'ParentID' => $this->ID,
                    'Tags.Title' => $tag));

            $list = PaginatedList::create($items, $this->request);
            //$list->setPageLength($pageSize);

            return $this->customise(array(
                'Filter' => 'Items tagged with "' . $tag . '"',
                'Items' => $list
            ));
        }
    }
}
