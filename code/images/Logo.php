<?php 
class Logo extends Image {

   function generateSmallBanner($gd) { 
      $gd->setQuality(100); 
      return $gd->croppedResize(940,230); 
   } 
   
   function generateSiteLogo($gd) {
    	if ($gd->getHeight() > 80 || $gd->getWidth() > 280) {
    		return $gd->resizeRatio(280,80);
    	} else {
    		return $gd;
    	}
   }
}