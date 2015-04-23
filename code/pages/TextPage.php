<?php

	class TextPage extends Page implements PermissionProvider{

		private static $singular_name = 'Text Page';
		private static $plural_name = 'Text Pages';
		private static $description = 'This page type provides a basic 1 column page supporting the content allowed in the main content zone of the CMS. This page type is primarily used for legal, privates, etc. pages on a site.';

		private static $defaults = array(
			'ShowInMenus' => 0);

        /**
         * @param Member $member
         * @return boolean
         */
        public function canView($member = null) {
            return parent::canView($member = null);
        }

        public function canEdit($member = null) {
            return Permission::check('TextPage_CRUD');
        }

        public function canDelete($member = null) {
            return Permission::check('TextPage_CRUD');
        }

        public function canCreate($member = null) {
            if (SiteMap::get()->first()) return false;
            return Permission::check('TextPage_CRUD');
        }

        public function providePermissions() {
            return array(
                //'Location_VIEW' => 'Read a Location',
                'TextPage_CRUD' => 'Create, Update and Delete a Text Page'
            );
        }

	}
	
	class TextPage_Controller extends Page_Controller{
		
		public function init(){
			parent::init();
			
		}
		
		
	}