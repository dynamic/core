<?php

namespace Dynamic\Core\Task;

use SilverStripe\Dev\BuildTask;
use SilverStripe\SiteConfig\SiteConfig;

class CompanyConfigTask extends BuildTask
{
    /**
     * @var string
     */
    protected $title = 'CompanyConfig Migration Task';
    /**
     * @var string
     */
    protected $description = 'Migrate company info from older version of Core to recent';
    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @param $request
     */
    public function run($request)
    {
        $this->updateCompanyConfig();
    }

    /**
     * migrate all Thumbnail records to PreivewImage.
     */
    public function updateCompanyConfig()
    {
        $config = SiteConfig::current_site_config();
        if ($config->PhoneNumber && !$config->Phone) {
            $config->Phone = $config->PhoneNumber;
            $config->write();
        }
        echo '<p>config updated.</p>';
    }
}
