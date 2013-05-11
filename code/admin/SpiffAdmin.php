<?php

class SpiffAdmin extends ModelAdmin {
    
  public static $managed_models = array(  
      'Spiff',
      'SpiffCategory'
   );
 
  static $url_segment = 'spiffs';
  static $menu_title = 'Spiffs';
 
}