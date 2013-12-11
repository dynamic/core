<?php

class SiteMap extends Page {

	private static $singular_name = "Site Map";
	private static $plural_name = "Site Maps";
	private static $description = "Displays a Site Map from your site's content";

	/**
	 * @return string
	 */
	public function getSitemap(DataList $set = null) {
		if(!$set) $set = $this->getRootPages();

		if($set && count($set)) {
			$sitemap = '<ul>';

			foreach($set as $page) {
				if($page->ShowInMenus && $page->ID != $this->ID && $page->canView()) {
					$sitemap .= sprintf (
						'<li><a href="%s" title="%s">%s</a>',
						$page->XML_val('Link'),
						$page->XML_val('MenuTitle'),
						$page->XML_val('Title')
					);

					if($children = $page->Children()) {
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
	public function getRootPages() {
		return SiteTree::get()->filter(array("ParentID" => 0, "ShowInMenus" => 1));
	}

}

class SiteMap_Controller extends Page_Controller {



}