<?php

namespace Dynamic\Core\Task;

use Dynamic\Core\Object\Spiff;
use SilverStripe\Dev\BuildTask;

/**
 * Class SpiffLinkableUpdateTask
 */
class SpiffLinkableUpdateTask extends BuildTask
{

    /**
     * @var string
     */
    protected $title = 'Spiffs Linkable Task';

    /**
     * @var string
     */
    protected $description = 'Update Spiffs to use Linkable DataExtension in dynamic/core-tools';

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @param $request
     */
    public function run($request)
    {
        $this->updateSpiffs();
    }

    /**
     * migrate all promos based on page type.
     */
    public function updateSpiffs()
    {
        $spiffs = Spiff::get();
        $ct = 0;
        foreach ($spiffs as $spiff) {
            if ($spiff->PageLinkID != 0 && ($spiff->LinkType == 'None' || $spiff->LinkType == null)) {
                $spiff->LinkType = 'Internal';
                $spiff->write();
                echo "<p>" . $spiff->Name . " - Internal Link</p>";
                $ct++;
            } elseif ($spiff->ExternalLink && ($spiff->LinkType == 'None' || $spiff->LinkType == null)) {
                $spiff->LinkType = 'External';
                $spiff->write();
                echo "<p>" . $spiff->Name . " - External Link</p>";
                $ct++;
            } elseif ($spiff->LinkType == null && ($spiff->PageLinkID == 0 || !$spiff->ExternalLink)) {
                $spiff->LinkType = 'None';
                $spiff->write();
                echo "<p>" . $spiff->Name . " - No Link</p>";
                $ct++;
            }
        }
        echo '<p>'.$ct.' spiffs updated.</p>';
    }
}
