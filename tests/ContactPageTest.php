<?php

namespace Dynamic\Core\Test;

use Dynamic\Core\Page\ContactPage;
use SilverStripe\ORM\DB;

class ContactPageTest extends DC_Test
{
    protected static $use_draft_site = true;

    public function setUp()
    {
        parent::setUp();
    }

    public function testBasicPageCreation()
    {
        $this->logInWithPermission('Contact_CRUD');
        $contact = singleton(ContactPage::class);
        $this->assertTrue($contact->canCreate());
        $this->logOut();
    }

    public function testBasicPageDeletion()
    {
        $this->logInWithPermission('ADMIN');
        $page = $this->objFromFixture(ContactPage::class, 'contact1');
        $pageID = $page->ID;

        $page->doPublish();
        $this->assertTrue($page->isPublished());

        $versions = DB::query('Select * FROM "SiteTree_Versions" WHERE "RecordID" = '. $pageID);
        $versionsPostPublish = array();
        foreach ($versions as $versionRow) {
            $versionsPostPublish[] = $versionRow;
        }

        $this->logOut();
        $this->logInWithPermission('Contact_CRUD');
        $this->assertTrue($page->canDelete());

        $page->delete();
        $this->assertTrue($page->isPublished());

        $versions = DB::query('Select * FROM "SiteTree_Versions" WHERE "RecordID" = '. $pageID);
        $versionsPostDelete = array();
        foreach ($versions as $versionRow) {
            $versionsPostDelete[] = $versionRow;
        }

        $this->assertTrue($versionsPostPublish == $versionsPostDelete);
    }
}
