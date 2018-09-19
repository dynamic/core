<?php

namespace Dynamic\Core\Page;

use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;
use SilverStripe\UserForms\Control\UserDefinedFormController;
use SilverStripe\UserForms\Model\UserDefinedForm;

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
     * @var string
     */
    private static $table_name = 'ContactPage';

    /**
     * @param Member $member
     * @return boolean
     */
    public function canView($member = null, $context = [])
    {
        return parent::canView($member = null);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canEdit($member = null, $context = [])
    {
        return Permission::check('Contact_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('Contact_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
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

class ContactPage_Controller extends UserDefinedFormController
{
}
