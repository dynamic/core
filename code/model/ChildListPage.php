<?php

	class ChildListPage extends Page{
		
		static $singular_name = 'Child List Page';
		static $plural_name = 'Child List Pages';
		static $description = 'This page lists its sub pages';
		
		static $hide_ancestor = "ChildListPage";
		
	}
	
	class ChildListPage_Controller extends Page_Controller{
		
		
		
	}