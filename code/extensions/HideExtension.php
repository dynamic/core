<?php

class HideExtension extends DataExtension {
	
	public function canCreate($member){ 
	   return false; 
	}
	
}