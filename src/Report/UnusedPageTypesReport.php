<?php

namespace Dynamic\Core\Report;

use SilverStripe\Core\ClassInfo;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Reports\Report;
use SilverStripe\View\ArrayData;

class UnusedPageTypesReport extends Report
{

    // the name of the report
    public function title()
    {
        return 'Unused Page Types';
    }

    // what we want the report to return
    public function sourceRecords($params = null)
    {
        //return Page::get()->sort('Title');

        $relations = ClassInfo::subclassesFor('Page');
        unset($relations['Page']);
        $results = new ArrayList();

        foreach ($relations as $key => $value) {
            if ($key::get()->count() < 1) {
                $results->push(new ArrayData(['Title' => singleton($value)->i18n_singular_name()]));
            }
        }
        return $results;
    }

    // which fields on that object we want to show
    public function columns()
    {
        $fields = array(
            'Title' => 'Title'
        );

        return $fields;
    }
}
