<?php

global $project;
$project = 'app';

// Use _ss_environment.php file for configuration
require_once("conf/ConfigureFromEnv.php");

MySQLDatabase::set_connection_charset('utf8');

// Set the current theme. More themes can be downloaded from
// http://www.silverstripe.org/themes/
SSViewer::set_theme('simple');

// Set the site locale
i18n::set_locale('en_US');

// Enable nested URLs for this site (e.g. page/sub-page/)
if (class_exists('SiteTree')) SiteTree::enable_nested_urls();

// Google Analytics
//GoogleLogger::activate('SiteConfig');
//GoogleAnalyzer::activate('SiteConfig');
//GoogleLogger::set_event_tracking_enabled(true);

// set Admin email
Email::setAdminEmail('debug@dynamicdoes.com');

// debug
SS_Log::add_writer(new SS_LogEmailWriter('debug@dynamicdoes.com'), SS_Log::WARN, '<=');

// SPAM protection
/*
RecaptchaField::$public_api_key = '6LeBWQkAAAAAAFmcDDLRDLUANd4GRFTcHhXYmSqS';
RecaptchaField::$private_api_key = '6LeBWQkAAAAAABMjw5QgyAOegJdUv9NJUWsxrOX9';
SpamProtectorManager::set_spam_protector("RecaptchaProtector");
*/

// Facebook Connect
/*
FacebookConnect::set_app_id('148903605251988');
FacebookConnect::set_api_secret('47f745ea430ee0f78a4b6833dc3626c5');
FacebookConnect::set_lang('en_US');
FacebookConnect::set_create_member(true); 
FacebookConnect::set_member_groups('facebook-members');
Authenticator::set_default_authenticator('FacebookAuthenticator');
*/

// Comments
Commenting::add('SiteTree');
Commenting::set_config_value('SiteTree', 'require_login', true);
BlogEntry::$defaults["ProvideComments"] = false;

// Header Config
Object::add_extension('SiteConfig', 'HeaderConfig');

// Company Info - add Addressable to SiteConfig
Object::add_extension('SiteConfig', 'Addressable');
Object::add_extension('SiteConfig', 'Geocodable');
Object::add_extension('SiteConfig', 'CompanyConfig');
//Object::add_extension('SiteConfig', 'SettingsConfig');

// Addressable to Calendar Events
//Object::add_extension('CalendarDateTime', 'Addressable');
//Object::add_extension('CalendarDateTime', 'Geocodable');

// Slideshow
//Object::add_extension('BlogEntry', 'FlexSlider');
Object::add_extension('HomePage', 'FlexSlider');
Object::add_extension('SlidePage', 'FlexSlider');
Object::add_extension('LandingPage', 'FlexSlider');