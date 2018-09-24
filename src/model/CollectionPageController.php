<?php

namespace Dynamic\Core\Model;

use SilverStripe\Core\Convert;
use SilverStripe\ORM\PaginatedList;

class CollectionPageController extends \PageController
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

        $object = (property_exists($this->Data()->ClassName, 'managed_detail')) ?
            $this->Data()->stat('managed_detail') :
            CollectionPage::getManagedDetail();
        $pageSize = (property_exists($this->Data()->ClassName, 'page_size')) ?
            $this->Data()->stat('page_size') :
            CollectionPage::getPageSize();
        $context = (method_exists($object, 'getCustomSearchContext')) ?
            singleton($object)->getCustomSearchContext() :
            singleton($object)->getDefaultSearchContext();
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

        $context = (method_exists($object, 'getCustomSearchContext')) ?
            singleton($object)->getCustomSearchContext() :
            singleton($object)->getDefaultSearchContext();
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
