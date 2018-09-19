<?php

namespace Dynamic\Core\Model;

use Dynamic\Core\Model\CollectionPage;
use Dynamic\Core\Model\DetailPage;
use Dynamic\Core\Object\Tag;
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

class CollectionPage_Controller extends \PageController
{
    /**
     * @var array
     */
    private static $allowed_actions = array(
        'tag',
        'AdvSearchForm'
    );

    /**
     * get child detail pages of this page
     *
     * @param array $searchCriteria
     * @return static
     */
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

        $form = Form::create(
            $this,
            'AdvSearchForm',
            $fields,
            $actions
        );

        $form->setFormMethod('get');

        return $form;
    }

    /**
     * Results filtered by query
     *
     * @param $data
     * @param $form
     * @param $request
     * @return string
     */
    public function search($data, $form, $request)
    {
        $limit = true;
        return $this->render(array(
            'Items' => $this->Items($data),
            'AdvSearchForm' => $form
        ));
    }

    /**
     * @param int $pageSize
     * @return ViewableData_Customised
     */
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

            return $this->customise(array(
                'Filter' => 'Items tagged with "' . $tag . '"',
                'Items' => $list
            ));
        }
    }
}
