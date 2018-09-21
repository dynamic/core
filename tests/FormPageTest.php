<?php

namespace Dynamic\Core\Test;

use Dynamic\Core\Page\FormPage;
use SilverStripe\ORM\DB;

class FormPageTest extends DC_Test
{

    protected static $use_draft_site = true;

    public function setUp()
    {
        parent::setUp();
    }

    public function testFormPageCreation()
    {

        $this->logInWithPermission('Form_CRUD');
        $form = singleton(FormPage::class);
        $this->assertTrue($form->canCreate());
        $this->logOut();
    }

    public function testFormPageDeletion()
    {

        $this->logInWithPermission('ADMIN');
        $page = $this->objFromFixture(FormPage::class, 'form1');
        $pageID = $page->ID;

        $page->doPublish();
        $this->assertTrue($page->isPublished());

        $versions = DB::query('Select * FROM "SiteTree_Versions" WHERE "RecordID" = '. $pageID);
        $versionsPostPublish = array();
        foreach ($versions as $versionRow) {
            $versionsPostPublish[] = $versionRow;
        }

        $this->logOut();
        $this->logInWithPermission('Form_CRUD');
        $this->assertTrue($page->canDelete());

        $this->markTestSkipped('need to revisit');
        $page->delete();
        $this->assertTrue(!$page->isPublished());

        $versions = DB::query('Select * FROM "SiteTree_Versions" WHERE "RecordID" = '. $pageID);
        $versionsPostDelete = array();
        foreach ($versions as $versionRow) {
            $versionsPostDelete[] = $versionRow;
        }

        $this->assertTrue($versionsPostPublish == $versionsPostDelete);
    }
}
