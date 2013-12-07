<?php

	class BasicPage extends DetailPage{

		static $singular_name = "Basic Page";
		static $plural_name = "Basic Pages";
		static $description = "Rich content page, includes large image area";
		
		static $hide_ancestor = "DetailPage";

	}

	class BasicPage_Controller extends DetailPage_Controller{



	}