<?php

class SpiffAdmin extends ModelAdmin {

  private static $managed_models = array(
      'Spiff',
      'SpiffCategory'
   );

  private static $url_segment = 'spiffs';
  private static $menu_title = 'Spiffs';

}