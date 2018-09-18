<?php

namespace Dynamic\Core\Admin;

use ModelAdmin;


class TagAdmin extends ModelAdmin {

	private static $url_segment = 'tags';
	private static $menu_title = 'Tags';
	private static $managed_models = array('Tag');
}