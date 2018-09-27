<?php

namespace Dynamic\Core\Admin;

use SilverStripe\Admin\ModelAdmin;
use Dynamic\Core\Model\Tag;

class TagAdmin extends ModelAdmin
{

    private static $url_segment = 'tags';
    private static $menu_title = 'Tags';
    private static $managed_models = array(Tag::class);
}
