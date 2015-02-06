<?php

class ContactPage extends UserDefinedForm implements PermissionProvider{

	private static $singular_name = "Contact Page";
	private static $plural_name = "Contact Pages";
	private static $description = 'Create a contact form. Includes company contact information and map';

	/**
	 * @param Member $member
	 * @return boolean
	 */
	public function canView($member = null) {
		return parent::canView($member = null);
	}

	public function canEdit($member = null) {
		return Permission::check('Contact_CRUD');
	}

	public function canDelete($member = null) {
		return Permission::check('Contact_CRUD');
	}

	public function canCreate($member = null) {
		return Permission::check('Contact_CRUD');
	}

	public function providePermissions() {
		return array(
			//'Location_VIEW' => 'Read a Location',
			'Contact_CRUD' => 'Create, Update and Delete a Contact Page'
		);
	}

}

class ContactPage_Controller extends UserDefinedForm_Controller {



}