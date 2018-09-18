<?php

namespace Dynamic\Core\Task;

use BuildTask;
use ClassInfo;
use SiteTree;


class PreviewExtensionMigrationTask extends BuildTask
{
    /**
     * @var string
     */
    protected $title = 'Preview Extension Migration';

    /**
     * @var string
     */
    protected $description = 'Migration task - migrate Thumbnail to PreviewImage';

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @param $request
     */
    public function run($request)
    {
        $this->updateObjectThumbnails();
    }

    /**
     * migrate all Thumbnail records to PreivewImage.
     */
    public function updateObjectThumbnails()
    {
        $objects = ClassInfo::subclassesFor('DataObject');
        unset($objects['DataObject']);

        $ct = 0;
        foreach ($objects as $object) {
            if (singleton($object)->hasExtension('PreviewExtension')) {
                $records = $object::get()->filter([
                    'ThumbnailID:GreaterThan' => 0,
                    'PreviewImageID' => 0,
                ]);
                foreach ($records as $record) {
                    $record->PreviewImageID = $record->ThumbnailID;
                    if (singleton($object) instanceOf SiteTree || singleton($object)->hasExtension('VersionedDataObject')) {
                        $record->writeToStage('Stage');
                        $record->publish('Stage', 'Live');
                    } else {
                        $record->write();
                    }
                    ++$ct;
                }
            }
        }
        echo '<p>'.$ct.' objects updated.</p>';
    }
}