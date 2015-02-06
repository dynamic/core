<?php

class EventPageTest extends DC_Test{

    protected static $use_draft_site = true;

    function setUp(){
        parent::setUp();

        $holder = EventHolder::create();
        $holder->Title = "Events";
        $holder->doPublish();
    }

    function testEventPageCreation(){

        $this->logInWithPermission('Event_CRUD');
        $page = singleton('EventPage');
        $this->assertTrue($page->canCreate());

        $event = new EventPage();
        $event->ParentID = EventHolder::get()->first()->ID;
        $event->Title = 'Our First Event';
        $event->Date = date('Y-m-d', strtotime('Next Thursday'));
        $event->Time = date('H:i:s', strtotime('5:30 pm'));
        $event->doPublish();
        $eventID = $event->ID;

        $this->assertTrue($eventID == EventPage::get()->first()->ID);

        $this->logOut();

    }

    function testEventPageDeletion(){

        $this->logInWithPermission('ADMIN');

        $event = new EventPage();
        $event->ParentID = EventHolder::get()->first()->ID;
        $event->Title = 'Our First Event';
        $event->Date = date('Y-m-d', strtotime('Next Thursday'));
        $event->Time = date('H:i:s', strtotime('5:30 pm'));
        $event->doPublish();
        $eventID = $event->ID;

        $this->assertTrue($event->isPublished());

        $versions = DB::query('Select * FROM "EventPage_versions" WHERE "RecordID" = '. $eventID);
        $versionsPostPublish = array();
        foreach($versions as $versionRow) $versionsPostPublish[] = $versionRow;

        $this->logOut();
        $this->logInWithPermission('Event_CRUD');
        $this->assertTrue($event->canDelete());

        $event->delete();
        $this->assertTrue(!$event->isPublished());

        $versions = DB::query('Select * FROM "EventPage_versions" WHERE "RecordID" = '. $eventID);
        $versionsPostDelete = array();
        foreach($versions as $versionRow) $versionsPostDelete[] = $versionRow;

        $this->assertTrue($versionsPostPublish == $versionsPostDelete);

    }

}
