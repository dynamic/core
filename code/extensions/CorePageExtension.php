<?php

class CorePageExtension extends Extension {

	public function onAfterInit() {
	
		// block flexslider.js from module
		//Requirements::block('flexslider/thirdparty/flexslider/jquery.flexslider-min.js');
	
		Requirements::combine_files(
			'site.js',
			array(
				'framework/thirdparty/jquery/jquery.min.js',
				'flexslider/thirdparty/flexslider/jquery.flexslider-min.js'
		));
		
		Requirements::combine_files(
			'site.css', 
			array(
				'themes/dynamicinc-white/css/typography.css',
				'themes/dynamicinc-white/css/form.css',
				'themes/dynamicinc-white/css/template.css',
				'themes/dynamicinc-white/css/all.css'
		));
		
		/*
		// ReCaptcha config
		Requirements::customScript("
			var RecaptchaOptions = {
			    theme : 'clean'
			 };"
		);
		*/
		
	}
	
}