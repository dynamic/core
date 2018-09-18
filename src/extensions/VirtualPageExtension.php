<?php

namespace Dynamic\Core\ORM;

use DataExtension;
use Permission;


	class VirtualPageExtension extends DataExtension{

		public function canCreate($member = null){
			return Permission::check('ADMIN');
		}

	}