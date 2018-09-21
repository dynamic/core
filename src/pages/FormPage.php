<?php

namespace Dynamic\Core\Page;

use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;
use SilverStripe\UserForms\Control\UserDefinedFormController;
use SilverStripe\UserForms\Model\UserDefinedForm;

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
     * @var string
     */
    private static $table_name = 'FormPage';

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
        return Permission::check('Form_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('Form_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
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
