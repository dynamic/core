<?php

namespace Dynamic\Core\Page;

class HolderItem extends DetailPage
{
    /**
     * @var string
     */
    private static $singular_name = "Holder Item";

    /**
     * @var string
     */
    private static $plural_name = "Holder Items";

    /**
     * @var string
     */
    public static $listing_page_class = HolderPage::class;

    /**
     * @var array
     */
    private static $defaults = array(
        'ShowInMenus' => 0
    );

    /**
     * @var string
     */
    private static $table_name = 'HolderItem';
}
