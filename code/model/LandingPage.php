<?php

class LandingPage extends Page {

	// getters for Thumbnail Previews
	public function getPreviewTitle() {

		if ($this->PreviewSubhead) {
			return $this->PreviewSubhead;
		} 
		
		return false;
	}
	
	// getters for relations
	public function getLinkList() {
		return $this->Links()->sort('SortOrder');
	}
		    
}

class LandingPage_Controller extends Page_Controller {
	
	
	
}