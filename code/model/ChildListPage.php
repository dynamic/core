<?php

	class ChildListPage extends Page{

		private static $singular_name = 'Child List Page';
		private static $plural_name = 'Child List Pages';
		private static $description = 'This page lists its sub pages';

		private static $hide_ancestor = "ChildListPage";

	}

	class ChildListPage_Controller extends Page_Controller{



	}