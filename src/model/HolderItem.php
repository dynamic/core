<?php

namespace Dynamic\Core\Model;




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
    public static $listing_page_class = 'HolderPage';

    /**
     * @var array
     */
    private static $defaults = array(
        'ShowInMenus' => 0
    );
}

class HolderItem_Controller extends DetailPage_Controller
{
}
