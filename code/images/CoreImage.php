<?php

class CoreImage extends Image {

	function generateThumb($gd) {
		return $gd->croppedResize(100,100);
	}

	function generateLargePadded($gd, $width = 600, $height = 400, $color = "000"){
		return $gd->paddedResize($width, $height, $color);
	}

}