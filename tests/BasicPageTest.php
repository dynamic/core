<?php

namespace Dynamic\Core\Test;

use Dynamic\Core\Page\BasicPage;
use SilverStripe\ORM\DB;

class BasicPageTest extends DC_Test
{

    protected static $use_draft_site = true;

    function setUp(){
        parent::setUp();
    }

    function testBasicPageCreation(){

        $this->logInWithPermission('Basic_CRUD');
        $page = singleton(BasicPage::class);
        $this->assertTrue($page->canCreate());
        $this->logOut();

    }

    function testBasicPageDeletion(){

        $this->logInWithPermission('ADMIN');
        $page = $this->objFromFixture(BasicPage::class, 'basic1');
        $pageID = $page->ID;

        $page->doPublish();
        $this->assertTrue($page->isPublished());

        $versions = DB::query('Select * FROM "SiteTree_versions" WHERE "RecordID" = '. $pageID);
        $versionsPostPublish = array();
        foreach($versions as $versionRow) $versionsPostPublish[] = $versionRow;

        $this->logOut();
        $this->logInWithPermission('Basic_CRUD');
        $this->assertTrue($page->canDelete());

        $page->delete();
        $this->assertTrue(!$page->isPublished());

        $versions = DB::query('Select * FROM "SiteTree_versions" WHERE "RecordID" = '. $pageID);
        $versionsPostDelete = array();
        foreach($versions as $versionRow) $versionsPostDelete[] = $versionRow;

        $this->assertTrue($versionsPostPublish == $versionsPostDelete);

    }

}
