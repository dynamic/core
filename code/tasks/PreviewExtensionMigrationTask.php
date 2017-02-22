<?php

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
        $this->updateThumbnails();
    }

    /**
     * migrate all Thumbnail records to PreivewImage.
     */
    public function updateThumbnails()
    {
        $pages = ClassInfo::subclassesFor('SiteTree');
        unset($pages['SiteTree']);

        $ct = 0;
        foreach ($pages as $page) {
            if (singleton($page)->hasExtension('PreviewExtension')) {
                $records = $page::get()->filter([
                    'ThumbnailID:GreaterThan' => 0,
                    'PreviewImageID' => 0,
                ]);
                foreach ($records as $record) {
                    $record->PreviewImageID = $record->ThumbnailID;
                    $record->writeToStage('Stage');
                    $record->publish('Stage', 'Live');
                    ++$ct;
                }
            }
        }
        echo '<p>'.$ct.' pages updated.</p>';
    }
}