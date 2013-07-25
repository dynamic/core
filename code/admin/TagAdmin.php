<?php

class TagAdmin extends ModelAdmin {

	public static $url_segment = 'tags';
	public static $menu_title = 'Tags';
	public static $managed_models = array('Tag');
}