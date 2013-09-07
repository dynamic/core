<?php

// enable site search
FulltextSearchable::enable();

// SPAM protection
SpamProtectorManager::set_spam_protector("MathSpamProtector");

// Addressable
if (class_exists('Addressable')) {
	Object::add_extension('SiteConfig', 'Addressable');
	Object::add_extension('SiteConfig', 'Geocodable');
}

// Comments
if (class_exists('Commenting')) {
	Commenting::add('SiteTree');
	Commenting::set_config_value('SiteTree', 'require_login', true);
	BlogEntry::$defaults["ProvideComments"] = false;
}


/* moved to YAML

// Core extensions
//Object::add_extension('SiteTree', 'CoreSiteTree');
//Object::add_extension('ContentController', 'CoreSiteTree_Controller');

// Site Config customization
Object::add_extension('SiteConfig', 'CompanyConfig');
Object::add_extension('SiteConfig', 'TemplateConfig');
Object::add_extension('SiteConfig', 'SettingsConfig');

// Preview Titles and Thumbnails for Holder Pages
DetailPage::add_extension('PreviewExtension');

// Spiffs
Object::add_extension('SectionPage', 'SpiffManager');
//Object::add_extension('CollectionPage', 'SpiffManager');

// FlexSlider
if (class_exists('FlexSlider')) {
	Object::add_extension('SectionPage', 'FlexSlider');
	Object::add_extension('DetailPage', 'FlexSlider');
	//Object::add_extension('CollectionPage', 'FlexSlider');
}
*/