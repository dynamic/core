<?php

class FormPage extends UserDefinedForm implements PermissionProvider
{
    /**
     * @var string
     */
    private static $hide_ancestor = "UserDefinedForm";

    /**
     * @var string
     */
    private static $singular_name = "Form Page";

    /**
     * @var string
     */
    private static $plural_name = "Form Pages";

    /**
     * @var string
     */
    private static $description = 'Create and display a form to store visitor submissions';

    /**
     * @param Member $member
     * @return boolean
     */
    public function canView($member = null)
    {
        return parent::canView($member = null);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canEdit($member = null)
    {
        return Permission::check('Form_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('Form_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null)
    {
        return Permission::check('Form_CRUD', 'any', $member);
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'Form_CRUD' => 'Create, Update and Delete a Form Page'
        );
    }
}

class FormPage_Controller extends UserDefinedForm_Controller
{
}
