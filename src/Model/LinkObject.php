<?php

namespace Dynamic\Core\Model;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataObject;

class LinkObject extends DataObject
{
    private static $db = array(
        'Name' => 'Varchar(255)',
        'URL' => 'Varchar(255)'
    );

    private static $has_one = array(
        'PageLink' => SiteTree::class
    );

    private static $belongs_many_many = array(
        'Pages' => \Page::class
    );

    private static $table_name = 'LinkObject';

    private static $singular_name = 'Link';
    private static $plural_name = 'Links';

    private static $default_sort = 'Name';

    private static $summary_fields = array(
        'Name' => 'Name',
        'PageLink.MenuTitle',
        'URL' => 'URL'
    );

    public function getExternal()
    {
        if ($url = $this->URL) {
            if (strstr($url, "http://") == $url || strstr($url, "https://") == $url) {
                return $url;
            } else {
                return 'http://' . $url;
            }
        }
        return false;
    }

    public function getCMSFields()
    {
        $fields = FieldList::create(
            $tabSet = new TabSet(
                'Root',
                $mainTab = new Tab(
                    'Main',
                    new TextField('Name'),
                    new HeaderField('LinkTitle', 'Choose destination'),
                    new TreeDropdownField('PageLinkID', 'Page', SiteTree::class),
                    new HeaderField('LinkOr', 'OR', 4),
                    new TextField('URL', 'URL (include http:// if external)')
                )
            )
        );

        return $fields;
    }

    // Set permissions, allow all users to access in ModelAdmin
    public function canCreate($member = null, $context = [])
    {
        return true;
    }

    public function canView($member = null, $context = [])
    {
        return true;
    }

    public function canEdit($member = null, $context = [])
    {
        return true;
    }

    public function canDelete($member = null, $context = [])
    {
        return true;
    }
}
