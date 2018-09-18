<?php

namespace Dynamic\Core\Admin;

use ModelAdmin;


class SpiffAdmin extends ModelAdmin {

  private static $managed_models = array(
      'Spiff'
   );

  private static $url_segment = 'spiffs';
  private static $menu_title = 'Spiffs';

}