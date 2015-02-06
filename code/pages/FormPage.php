<?php

class FormPage extends UserDefinedForm implements PermissionProvider{

	private static $hide_ancestor = "UserDefinedForm";

	private static $singular_name = "Form Page";
	private static $plural_name = "Form Pages";
	private static $description = 'Create and display a form to store visitor submissions';

	/**
	 * @param Member $member
	 * @return boolean
	 */
	public function canView($member = null) {
		return parent::canView($member = null);
	}

	public function canEdit($member = null) {
		return Permission::check('Form_CRUD');
	}

	public function canDelete($member = null) {
		return Permission::check('Form_CRUD');
	}

	public function canCreate($member = null) {
		return Permission::check('Form_CRUD');
	}

	public function providePermissions() {
		return array(
			//'Location_VIEW' => 'Read a Location',
			'Form_CRUD' => 'Create, Update and Delete a Form Page'
		);
	}

}

class FormPage_Controller extends UserDefinedForm_Controller {



}