<?php

// enable site search
FulltextSearchable::enable();

// SPAM protection
if (class_exists('SpamProtectorManager') && class_exists('MathSpamProtector')) {
    SpamProtectorManager::set_spam_protector("MathSpamProtector");
}

// Addressable
if (class_exists('Addressable')) {
	Object::add_extension('SiteConfig', 'Addressable');
	Object::add_extension('SiteConfig', 'Geocodable');
}

// set image upload max size
define('CORE_IMAGE_FILE_SIZE_LIMIT', 512000);