<?php

// enable site search
use SilverStripe\ORM\Search\FulltextSearchable;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\SpamProtection\SpamProtector;
use Symbiote\Addressable\Addressable;
use Symbiote\Addressable\Geocodable;

FulltextSearchable::enable();

// SPAM protection
if (class_exists('SpamProtectorManager') && class_exists('MathSpamProtector')) {
    SpamProtector::set_spam_protector("MathSpamProtector");
}

// Addressable
if (class_exists('Addressable')) {
    SiteConfig::add_extension(Addressable::class);
    SiteConfig::add_extension( Geocodable::class);
}

// set image upload max size
define('CORE_IMAGE_FILE_SIZE_LIMIT', 512000);