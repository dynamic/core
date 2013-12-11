<?php

	class BasicPage extends DetailPage{

		private static $singular_name = "Basic Page";
		private static $plural_name = "Basic Pages";
		private static $description = "Rich content page, includes large image area";

		private static $hide_ancestor = "DetailPage";

	}

	class BasicPage_Controller extends DetailPage_Controller{



	}