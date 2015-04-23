<?php

class AlbumCollectionPage extends CollectionPage implements PermissionProvider{

	private static $singular_name = 'Album collection page';
	private static $plural_name = 'Album collection pages';
	private static $description = 'Collection page showing all albums';

	private static $managed_detail = 'AlbumPage';
	private static $page_size = 10;

    /**
     * @param Member $member
     * @return boolean
     */
    public function canView($member = null) {
        return parent::canView($member = null);
    }

    public function canEdit($member = null) {
        return Permission::check('AlbumCollectionPage_CRUD');
    }

    public function canDelete($member = null) {
        return Permission::check('AlbumCollectionPage_CRUD');
    }

    public function canCreate($member = null) {
        return Permission::check('AlbumCollectionPage_CRUD');
    }

    public function providePermissions() {
        return array(
            //'Location_VIEW' => 'Read a Location',
            'AlbumCollectionPage_CRUD' => 'Create, Update and Delete a Album Collection Page'
        );
    }

}

class AlbumCollectionPage_Controller extends CollectionPage_Controller {

	private static $allowed_actions = array(
		'tag',
		'AdvSearchForm'
	);

	// get child detail pages of this page
	public function Items($searchCriteria = array()){

		$request = ($this->request) ? $this->request : $this->parentController->getRequest();
		if(empty($searchCriteria)) $searchCriteria = $request->requestVars();

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

	// Search Objects
	public function AdvSearchForm() {

		$Object = singleton('DetailPage');

		$context = $Object->getDefaultSearchContext();
		$fields = $context->getSearchFields();

		$actions = new FieldList(
			new FormAction('search', 'Search')
		);

		$form = Form::create($this, "AdvSearchForm",
			$fields,
			$actions
		);

		$form->setFormMethod('get');

		return $form;
	}


	// Results filtered by query
	function search($data, $form, $request) {
		$limit = true;
		return $this->render(array(
			'Items' => $this->Items($data),
			'AdvSearchForm' => $form
		));
	}

	public function tag($pageSize = 10) {
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