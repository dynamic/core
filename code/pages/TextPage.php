<?php

	class TextPage extends Page{

		private static $singular_name = 'Text Page';
		private static $plural_name = 'Text Pages';
		private static $description = 'This page type provides a basic 1 column page supporting the content allowed in the main content zone of the CMS. This page type is primarily used for legal, privates, etc. pages on a site.';

		private static $defaults = array(
			'ShowInMenus' => 0);

	}