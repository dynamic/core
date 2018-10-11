<?php


/**
 * Class AlertExtension
 *
 * @property string $AlertMessage
 * @property boolean $ShowAlert
 *
 * @method \HasManyList AllowedDomains()
 *
 * @property \DataObject|\AlertExtension $owner
 */
class AlertExtension extends DataExtension
{

    /**
     * @var array
     */
    private static $db = array(
        'AlertMessage' => 'HTMLText',
        'ShowAlert' => 'Boolean',
    );

    /**
     * @var array
     */
    private static $has_many = array(
        'AllowedDomains' => AllowedDomain::class,
    );

    /**
     * @param \FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        $config = GridFieldConfig_RelationEditor::create()
            ->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
        $tableField = GridField::create(
            'AllowedDomains',
            _t('SiteConfigDataExtension.AllowedDomains', 'Allowed Domains'),
            $this->owner->AllowedDomains(),
            $config
        );
        $tableField->setDescription('just include domain name and subdomains - ex: example.' . $_SERVER["SERVER_NAME"]);

        $fields->addFieldsToTab('Root.Alert', array(
            HeaderField::create('AlertHD', 'Alert Message', 3),
            CheckboxField::create('ShowAlert', 'Show Alert Message'),
            HTMLEditorField::create('AlertMessage', 'Message'),
            $tableField,
        ));
    }
}