<?php

class DynamicHomePage extends SectionPage implements PermissionProvider{

	private static $singular_name = "Home Page";
	private static $plural_name = "Home Pages";
	private static $description = 'Website homepage, includes slides and spiffs';

	private static $defaults = array(
		'ShowInMenus' => 0
	);

    /**
     * @param Member $member
     * @return boolean
     */
    public function canView($member = null) {
        return parent::canView($member = null);
    }

    public function canEdit($member = null) {
        return Permission::check('DynamicHomePage_CRUD');
    }

    public function canDelete($member = null) {
        return Permission::check('DynamicHomePage_CRUD');
    }

    public function canCreate($member = null) {
        if (DynamicHomePage::get()->first()) return false;
        return Permission::check('DynamicHomePage_CRUD');
    }

    public function providePermissions() {
        return array(
            //'Location_VIEW' => 'Read a Location',
            'DynamicHomePage_CRUD' => 'Create, Update and Delete a Home Page'
        );
    }

}

class DynamicHomePage_Controller extends SectionPage_Controller {



}