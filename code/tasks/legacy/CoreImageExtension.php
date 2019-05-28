<?php

/**
 * Class CoreImageExtension
 */
class CoreImageExtension Extends Extension
{
	public function LargePadded($width = 600, $height = 400, $color = "000")
	{
		Deprecation::notice('0.1', 'Use $Image.PaddedImage() instead');
		return $this->owner->PaddedImage($width, $height, $color);
	}

	public function generateThumb()
	{
		Deprecation::notice('0.1', 'Use $Image.CroppedImage(100, 100) instead');
		return $this->owner->CroppedImage(100, 100);
	}
}
