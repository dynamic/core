<?php

namespace Dynamic\Core\Admin;

use Dynamic\Core\Object\Spiff;
use SilverStripe\Admin\ModelAdmin;

class SpiffAdmin extends ModelAdmin
{
    /**
     * @var array
     */
    private static $managed_models = array(
      Spiff::class
    );

    /**
     * @var string
     */
    private static $url_segment = 'spiffs';

    /**
     * @var string
     */
    private static $menu_title = 'Spiffs';
}
