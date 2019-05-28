<?php

/**
 * Class CoreImageTask
 */
class CoreImageTask extends BuildTask
{
	protected $title = 'Core Image converter';
	protected $description = 'Converts CoreImage to Image';
	protected $enabled = true;

	public function run($request)
	{
		$count = 0;
		File::get()->each(function (File $file) use (&$count) {
			if ($file->getObsoleteClassName() === 'CoreImage') {
				$file = $file->newClassInstance(Image::class);
				$file->write();
				$count++;
			}
		});
		echo 'updated ' . $count . ' records.';
	}
}
