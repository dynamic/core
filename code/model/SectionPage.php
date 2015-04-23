<?php

class SectionPage extends Page implements PermissionProvider{

    /**
     * @param Member $member
     * @return boolean
     */
    public function canView($member = null) {
        return parent::canView($member = null);
    }

    public function canEdit($member = null) {
        return Permission::check('SectionPage_CRUD');
    }

    public function canDelete($member = null) {
        return Permission::check('SectionPage_CRUD');
    }

    public function canCreate($member = null) {
        return Permission::check('SectionPage_CRUD');
    }

    public function providePermissions() {
        return array(
            //'Location_VIEW' => 'Read a Location',
            'SectionPage_CRUD' => 'Create, Update and Delete a Section Page'
        );
    }

}

class SectionPage_Controller extends Page_Controller {



}