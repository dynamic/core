<?php

/**
 * Class SpiffAdmin
 */
class SpiffAdmin extends ModelAdmin
{
    /**
     * @var array
     */
    private static $managed_models = [
        'Spiff',
    ];

    /**
     * @var string
     */
    private static $url_segment = 'spiffs';

    /**
     * @var string
     */
    private static $menu_title = 'Spiffs';

    /**
     * @return SS_List
     */
    public function getList()
    {
        $list = parent::getList();

        $list = $list->filter('ClassName', Spiff::class);

        return $list;
    }
}