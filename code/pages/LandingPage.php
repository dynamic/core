<?php

class LandingPage extends SectionPage implements PermissionProvider{

	private static $singluar_name = "Landing Page";
	private static $plural_name = "Landing Pages";
	private static $description = 'Section Landing Page, displays list of subpages';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$this->extend('updateCMSFields', $fields);
		return $fields;
	}

    /**
     * @param Member $member
     * @return boolean
     */
    public function canView($member = null) {
        return parent::canView($member = null);
    }

    public function canEdit($member = null) {
        return Permission::check('LandingPage_CRUD');
    }

    public function canDelete($member = null) {
        return Permission::check('LandingPage_CRUD');
    }

    public function canCreate($member = null) {
        return Permission::check('LandingPage_CRUD');
    }

    public function providePermissions() {
        return array(
            //'Location_VIEW' => 'Read a Location',
            'LandingPage_CRUD' => 'Create, Update and Delete a Landing Page'
        );
    }

}

class LandingPage_Controller extends SectionPage_Controller {



}