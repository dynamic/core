<?php


/**
 * Class AllowedDomain
 *
 * Set relations through a DataExtension or config
 *
 * @property string $URL
 */
class AllowedDomain extends DataObject
{
    /**
     * @var array
     */
    private static $db = array(
        'URL' => 'Varchar(255)'
    );

    /**
     * @var array
     */
    private static $summary_fields = array(
        'URL'
    );

    /**
     * @param \Member|null $member
     * @param array $context
     * @return bool
     */
    public function canCreate($member = null, $context = array())
    {
        return true;
    }

    /**
     * @param \Member|null $member
     * @return bool
     */
    public function canEdit($member = null)
    {
        return true;
    }

    /**
     * @param \Member|null $member
     * @return bool
     */
    public function canView($member = null)
    {
        return true;
    }

    /**
     * @param \Member|null $member
     * @return bool
     */
    public function canDelete($member = null)
    {
        return true;
    }
}