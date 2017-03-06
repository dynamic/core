<?php

class ContactPage extends UserDefinedForm implements PermissionProvider
{
    /**
     * @var string
     */
    private static $singular_name = "Contact Page";

    /**
     * @var string
     */
    private static $plural_name = "Contact Pages";

    /**
     * @var string
     */
    private static $description = 'Create a contact form. Includes company contact information and map';

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
        return Permission::check('Contact_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('Contact_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null)
    {
        return Permission::check('Contact_CRUD', 'any', $member);
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'Contact_CRUD' => 'Create, Update and Delete a Contact Page'
        );
    }
}

class ContactPage_Controller extends UserDefinedForm_Controller
{
}
