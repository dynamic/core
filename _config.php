<?php

// enable site search
FulltextSearchable::enable();

// SPAM protection
if (class_exists('SpamProtectorManager')) {
    SpamProtectorManager::set_spam_protector("MathSpamProtector");
}

// Addressable
if (class_exists('Addressable')) {
	Object::add_extension('SiteConfig', 'Addressable');
	Object::add_extension('SiteConfig', 'Geocodable');
}