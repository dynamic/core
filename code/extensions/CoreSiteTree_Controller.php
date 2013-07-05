<?php

class CoreSiteTree_Controller extends Extension {

	static $allowed_actions = array();

	function onAfterInit() {
		// Add the combined scripts.
		
		// path variables
		$themeDir = SSViewer::get_theme_folder();
		$config = SiteConfig::current_site_config(); 
		
		// clear
		Requirements::clear('userforms/thirdparty/jquery-validate/jquery.validate.js');
		Requirements::clear('userforms/javascript/UserForm_frontend.js');
		
		$scripts = array(
			'framework/thirdparty/jquery/jquery.min.js',
			'flexslider/thirdparty/flexslider/jquery.flexslider-min.js',
			$themeDir . '/javascript/jquery.lazyload.min.js',
			$themeDir . '/javascript/lazy_init.js',
			$themeDir . '/javascript/meanMenu/jquery.meanmenu.2.0.min.js',
			'userforms/thirdparty/jquery-validate/jquery.validate.js',
			'userforms/javascript/UserForm_frontend.js'
		);
			
		Requirements::combine_files('scripts.js', $scripts);
		
		// external scripts
		Requirements::javascript('//s7.addthis.com/js/300/addthis_widget.js#pubid=' . $config->AddThisProfileID);

		// Add the combined styles.
		$styles = array(
			$themeDir . '/css/base.css',
			'flexslider/thirdparty/flexslider/flexslider.css',
			$themeDir . '/css/layout.css',
			$themeDir . '/css/typography.css',
			$themeDir . '/css/form.css',
			$themeDir . '/javascript/meanMenu/meanmenu.css',
			$themeDir . '/css/skeleton.css',
		);

		Requirements::combine_files('styles.css', $styles);
		
		// print css
		Requirements::css($themeDir . '/css/print.css', 'print');
		
		// blocked
		Requirements::block('framework/thirdparty/jquery/jquery.js');
		//Requirements::block('flexslider/thirdparty/flexslider/flexslider.css');
		
		// meanMenu plugin
		//Requirements::customScript("
		//	jQuery(document).ready(function () {
		//    	jQuery('.header nav').meanmenu();
		//    });
		//");
		
		// AddThis social sharing
		Requirements::customScript('
			//var addthis_config = { "data_track_addressbar":true };
			
			var addthis_share = {
				url_transforms : {
					shorten: {
						twitter: "bitly"
					}
				}, 
				shorteners : {
					bitly : {} 				}
			};
		');
		
		/*
		// ReCaptcha config
		Requirements::customScript("
			var RecaptchaOptions = {
			    theme : 'clean'
			 };"
		);
		*/
		
		// Extra folder to keep the relative paths consistent when combining.
		Requirements::set_combined_files_folder(ASSETS_DIR . '/_combined');
		
	}
	
}