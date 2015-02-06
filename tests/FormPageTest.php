<?php

class FormPageTest extends DC_Test{

    protected static $use_draft_site = true;

    function setUp(){
        parent::setUp();
    }

    function testFormPageCreation(){

        $this->logInWithPermission('Form_CRUD');
        $form = singleton('FormPage');
        $this->assertTrue($form->canCreate());
        $this->logOut();

    }

    function testFormPageDeletion(){

        $this->logInWithPermission('ADMIN');
        $page = $this->objFromFixture('FormPage', 'form1');
        $pageID = $page->ID;

        $page->doPublish();
        $this->assertTrue($page->isPublished());

        $versions = DB::query('Select * FROM "SiteTree_versions" WHERE "RecordID" = '. $pageID);
        $versionsPostPublish = array();
        foreach($versions as $versionRow) $versionsPostPublish[] = $versionRow;

        $this->logOut();
        $this->logInWithPermission('Form_CRUD');
        $this->assertTrue($page->canDelete());

        $page->delete();
        $this->assertTrue(!$page->isPublished());

        $versions = DB::query('Select * FROM "SiteTree_versions" WHERE "RecordID" = '. $pageID);
        $versionsPostDelete = array();
        foreach($versions as $versionRow) $versionsPostDelete[] = $versionRow;

        $this->assertTrue($versionsPostPublish == $versionsPostDelete);

    }

}
