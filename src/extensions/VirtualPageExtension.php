<?php

namespace Dynamic\Core\ORM;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Permission;

class VirtualPageExtension extends DataExtension
{

    public function canCreate($member = null)
    {
        return Permission::check('ADMIN');
    }
}
