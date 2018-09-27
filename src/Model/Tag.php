<?php

namespace Dynamic\Core\Model;

use Dynamic\Core\Page\DetailPage;
use SilverStripe\Control\Controller;
use SilverStripe\ORM\DataObject;

class Tag extends DataObject
{

    private static $db = array(
        'Title' => 'Varchar(200)'
    );

    private static $belongs_many_many = array(
        'Pages' => DetailPage::class
    );

    private static $table_name = 'CoreTag';

    public function getLink()
    {
        $controller = Controller::curr();
        $class = $controller->Data()->ClassName;

        if ($class == DetailPage::class || is_subclass_of($class, DetailPage::class)) {
            if ($controller->Data()->Parent()->Parent()) {
                return $controller->Data()->Parent()->Parent()->URLSegment.'/'.$controller->Data()->Parent()
                    ->URLSegment.'/tag/'.htmlentities($this->Title);
            } else {
                return $controller->Data()->Parent()->URLSegment."/tag/".htmlentities($this->Title);
            }
        } else {
            return $controller->join_links($controller->Link('tag'), htmlentities($this->Title));
        }
    }

    public function getRelatedPages()
    {

        $controller = Controller::curr();
        $class = $controller->Data()->ClassName;

        if ($class == DetailPage::class || is_subclass_of($class, DetailPage::class)) {
            $parentID = $controller->Data()->Parent()->ID;
        } else {
            $parentID = $controller->Data()->ID;
        }

        $pages = DetailPage::get()
            ->filter(array('Tags.ID'=>$this->ID,'ParentID'=>$parentID));

        return $pages->Count();
    }

    public function CurrentLevel()
    {
        $page = $this;
        $level = 1;
        while (1) {
            if ($page->Parent) {
                $level++;
                $page = $page->Parent();
            } else {
                return $level;
            }
        }
    }
}
