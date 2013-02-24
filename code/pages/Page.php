<?php
class Page extends SiteTree {

	public static $db = array(
	);

	public static $has_one = array(
	);
	
	// permissions
	public function isCMSAdmin() {
		return permission::check('CMS_ACCESS_CMSMain');
	}

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	public static $allowed_actions = array (
	);

	public function init() {
		parent::init();
		
		Requirements::combine_files(
		    'site.css',
		    array(
		        $this->ThemeDir() . '/css/base.css',
		        $this->ThemeDir() . '/css/skeleton.css',
		        $this->ThemeDir() . '/css/layout.css',
		        $this->ThemeDir() . '/css/form.css',
		        $this->ThemeDir() . '/css/typography.css'
		        //'flexslider/thirdparty/flexslider/flexslider.css',
		    )
		);
		
		Requirements::combine_files(
		    'site.js',
		    array(
		        'framework/thirdparty/jquery/jquery.min.js',
		        //'flexslider/thirdparty/flexslider/jquery.flexslider-min.js',
		        //'flexslider/javascript/flexslider_init.js',
		        //'minicart/vendor/MiniCart/dist/minicart.js'
		    )
		);
		
		//Requirements::javascript('framework/thirdparty/jquery/jquery.js');
	}

}