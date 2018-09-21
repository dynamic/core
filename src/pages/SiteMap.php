<?php

namespace Dynamic\Core\Page;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;

class SiteMap extends \Page implements PermissionProvider
{
    /**
     * @var string
     */
    private static $singular_name = "Site Map";

    /**
     * @var string
     */
    private static $plural_name = "Site Maps";

    /**
     * @var string
     */
    private static $description = "Displays a Site Map from your site's content";

    /**
     * @var string
     */
    private static $table_name = 'SiteMap';

    /**
     * @return string
     */
    public function getSitemap($set = null)
    {
        if (!$set) {
            $set = $this->getRootPages();
        }

        if ($set && count($set)) {
            $sitemap = '<ul>';

            foreach ($set as $page) {
                if ($page->ShowInMenus && $page->ID != $this->ID && $page->canView()) {
                    $sitemap .= sprintf(
                        '<li><a href="%s" title="%s">%s</a>',
                        $page->XML_val('Link'),
                        $page->XML_val('MenuTitle'),
                        $page->XML_val('Title')
                    );

                    if ($children = $page->Children()) {
                        $sitemap .= $this->getSitemap($children);
                    }

                    $sitemap .= '</li>';
                }
            }

            return $sitemap .'</ul>';
        }
    }

    /**
     * @return DataList
     */
    public function getRootPages()
    {
        return SiteTree::get()->filter(array("ParentID" => 0, "ShowInMenus" => 1));
    }

    /**
     * @param Member $member
     * @return boolean
     */
    public function canView($member = null, $context = [])
    {
        return parent::canView($member = null);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canEdit($member = null, $context = [])
    {
        return Permission::check('SiteMapPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return Permission::check('SiteMapPage_CRUD', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        if (SiteMap::get()->first()) {
            return false;
        }
        return Permission::check('SiteMapPage_CRUD', 'any', $member);
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return array(
            'SiteMapPage_CRUD' => 'Create, Update and Delete a Site Map Page'
        );
    }
}
