<?php

	class ChildListPage extends Page implements PermissionProvider{

        /**
         * @param Member $member
         * @return boolean
         */
        public function canView($member = null) {
            return parent::canView($member = null);
        }

        public function canEdit($member = null) {
            return Permission::check('ChildListPage_CRUD');
        }

        public function canDelete($member = null) {
            return Permission::check('ChildListPage_CRUD');
        }

        public function canCreate($member = null) {
            return Permission::check('BasChildListPage_CRUDic_CRUD');
        }

        public function providePermissions() {
            return array(
                //'Location_VIEW' => 'Read a Location',
                'ChildListPage_CRUD' => 'Create, Update and Delete a Child List Page'
            );
        }

	}

	class ChildListPage_Controller extends Page_Controller{



	}