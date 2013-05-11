<?php

// Page Init
//Object::add_extension('Page_Controller', 'CorePageExtension');

// Header Config
if (class_exists('HeaderConfig')) Object::add_extension('SiteConfig', 'HeaderConfig');

// Company Info - add Addressable to SiteConfig

if (class_exists('Addressable')) {
	Object::add_extension('SiteConfig', 'Addressable');
	Object::add_extension('SiteConfig', 'Geocodable');
	//Object::add_extension('SiteConfig', 'CompanyConfig');
}

// Spiffs
Object::add_extension('DynamicHomePage', 'SpiffManager');

// Slideshow
if (class_exists('FlexSlider')) {
	Object::add_extension('DynamicHomePage', 'FlexSlider');
	Object::add_extension('SlidePage', 'FlexSlider');
	Object::add_extension('LandingPage', 'FlexSlider');
}

// SPAM protection
/*
RecaptchaField::$public_api_key = '6LeBWQkAAAAAAFmcDDLRDLUANd4GRFTcHhXYmSqS';
RecaptchaField::$private_api_key = '6LeBWQkAAAAAABMjw5QgyAOegJdUv9NJUWsxrOX9';
SpamProtectorManager::set_spam_protector("RecaptchaProtector");
*/

/*
// Comments
if (class_exists('Commenting')) {
	Commenting::add('SiteTree');
	Commenting::set_config_value('SiteTree', 'require_login', true);
	BlogEntry::$defaults["ProvideComments"] = false;
}
*/