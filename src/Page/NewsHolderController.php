<?php

namespace Dynamic\Core\Page;

use Dynamic\Core\Page\HolderPageController;
use SilverStripe\ORM\FieldType\DBDatetime;

class NewsHolderController extends HolderPageController
{
    /**
     * @var array
     */
    private static $allowed_actions = array(
        'tag',
        'archive',
        'rss'
    );

    /**
     * @param null $request
     * @return ViewableData_Customised
     */
    public function archive($request = null)
    {
        $params = $request->allParams();

        if ($year = $params['ID']) {
            if ($month = $params['OtherID']) {
                $start = $year."-".$month."-01";
                $monthWord = date('F', strtotime($start));
                $end = date('y-m-dd', strtotime("last day of $monthWord $year"));
            } else {
                $start = "$year-01-01";
                $end = "$year-12-31";
            }

            $from = DBDatetime::create();
            $from->setValue($start);
            $to = DBDatetime::create();
            $to->setValue($end);

            $filter = array(
                'ParentID' => $this->data()->ID,
                'DateAuthored:GreaterThan' => $from->getValue(),
                'DateAuthored:LessThanOrEqual' => $to->getValue(),
            );

            return $this->customise(array(
                'Items' => NewsArticle::get()
                    ->filter($filter)
                    ->sort('DateAuthored', 'DESC')));
        }

        $message = "Please use a valid archive url (i.e. ".$this->Link('archive')."/2013/ for a year or ".
            $this->Link('archive')."/2013/07/ for a year/month";

        return $this->customise(array(
            'Items' =>false,
            'Message' => $message));
    }
}
