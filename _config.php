<?php

Object::add_extension('SiteTree', 'CoreSiteTree');
Object::add_extension('ContentController', 'CoreSiteTree_Controller');
Object::add_extension('Page', 'PageExtension');
Object::add_extension('SiteConfig', 'CompanyConfig');
Object::add_extension('SiteConfig', 'TemplateConfig');
Object::add_extension('SiteConfig', 'SettingsConfig');

// add Addressable to SiteConfig
if (class_exists('Addressable')) {
	Object::add_extension('SiteConfig', 'Addressable');
	Object::add_extension('SiteConfig', 'Geocodable');
}

// Spiffs
Object::add_extension('DynamicHomePage', 'SpiffManager');
Object::add_extension('LandingPage', 'SpiffManager');

// Slideshow
if (class_exists('FlexSlider')) {
	Object::add_extension('DynamicHomePage', 'FlexSlider');
	Object::add_extension('SlidePage', 'FlexSlider');
	Object::add_extension('LandingPage', 'FlexSlider');
	Object::add_extension('NewsArticle', 'FlexSlider');
}

// Tags
Object::add_extension('Page', 'TagExtension');

// SPAM protection
/*
RecaptchaField::$public_api_key = '6LeBWQkAAAAAAFmcDDLRDLUANd4GRFTcHhXYmSqS';
RecaptchaField::$private_api_key = '6LeBWQkAAAAAABMjw5QgyAOegJdUv9NJUWsxrOX9';
SpamProtectorManager::set_spam_protector("RecaptchaProtector");
*/

// Comments
if (class_exists('Commenting')) {
	Commenting::add('SiteTree');
	Commenting::set_config_value('SiteTree', 'require_login', true);
	BlogEntry::$defaults["ProvideComments"] = false;
}

// SPAM protection
SpamProtectorManager::set_spam_protector("MathSpamProtector");