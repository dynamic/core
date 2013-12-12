<?php

	class VirtualPageExtension extends DataExtension{

		public function canCreate($member = null){
			return Permission::check('ADMIN');
		}

	}