<?php

class SlidePage extends Page {
	
	
	
}

class SlidePage_Controller extends Page_Controller {
	
	// previous/next page links on detail pages and related
	public function PrevNextPage($Mode = 'next') {
   
	  if($Mode == 'next'){
	    $Where = "ParentID = ($this->ParentID) AND Sort > ($this->Sort)";
	    $Sort = "Sort ASC";
	  }
	  elseif($Mode == 'prev'){
	    $Where = "ParentID = ($this->ParentID) AND Sort < ($this->Sort)";
	    $Sort = "Sort DESC";
	  }
	  else{
	    return false;
	  }
	   
	  return DataObject::get("SiteTree", $Where, $Sort, null, 1);
	     
	}
	
}