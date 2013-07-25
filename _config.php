<?php

FulltextSearchable::enable();

Object::add_extension('SiteTree', 'CoreSiteTree');
Object::add_extension('ContentController', 'CoreSiteTree_Controller');
Object::add_extension('SiteConfig', 'CompanyConfig');
Object::add_extension('SiteConfig', 'TemplateConfig');
Object::add_extension('SiteConfig', 'SettingsConfig');

// add Addressable to SiteConfig
if (class_exists('Addressable')) {
	Object::add_extension('SiteConfig', 'Addressable');
	Object::add_extension('SiteConfig', 'Geocodable');
}

// Spiffs
Object::add_extension('SectionPage', 'SpiffManager');
//Object::add_extension('CollectionPage', 'SpiffManager');

// Slideshow
if (class_exists('FlexSlider')) {
	Object::add_extension('SectionPage', 'FlexSlider');
	//Object::add_extension('CollectionPage', 'FlexSlider');
	Object::add_extension('DetailPage', 'FlexSlider');
}

// Comments
if (class_exists('Commenting')) {
	Commenting::add('SiteTree');
	Commenting::set_config_value('SiteTree', 'require_login', true);
	BlogEntry::$defaults["ProvideComments"] = false;
}

// SPAM protection
SpamProtectorManager::set_spam_protector("MathSpamProtector");