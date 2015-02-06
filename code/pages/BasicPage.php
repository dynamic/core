<?php

	class BasicPage extends DetailPage implements PermissionProvider{

		private static $singular_name = "Basic Page";
		private static $plural_name = "Basic Pages";
		private static $description = "Rich content page, includes large image area";


		/**
		 * @param Member $member
		 * @return boolean
		 */
		public function canView($member = null) {
			return parent::canView($member = null);
		}

		public function canEdit($member = null) {
			return Permission::check('Basic_CRUD');
		}

		public function canDelete($member = null) {
			return Permission::check('Basic_CRUD');
		}

		public function canCreate($member = null) {
			return Permission::check('Basic_CRUD');
		}

		public function providePermissions() {
			return array(
				//'Location_VIEW' => 'Read a Location',
				'Basic_CRUD' => 'Create, Update and Delete a Basic Page'
			);
		}

	}

	class BasicPage_Controller extends DetailPage_Controller{



	}