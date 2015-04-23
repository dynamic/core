<?php

class AlbumPageTest extends DC_Test{

    protected static $use_draft_site = true;

    function setUp(){
        parent::setUp();

        $holder = AlbumGroupPage::create();
        $holder->Title = 'Albums';
        $holder->write();
        $holder->doPublish();
    }

    function testAlbumPageCreation(){

        $this->logInWithPermission('Album_CRUD');
        $album = singleton('AlbumPage');
        $this->assertTrue($album->canCreate());
        $this->logOut();

    }

    function testAlbumPageDeletion(){

        $this->logInWithPermission('ADMIN');

        $holder = AlbumGroupPage::get()->first();
        $album = $this->objFromFixture('AlbumPage', 'album1');
        $album->ParentID = $holder->ID;
        $albumID = $album->ID;

        $album->doPublish();
        $this->assertTrue($album->isPublished());

        $versions = DB::query('Select * FROM "SiteTree_versions" WHERE "RecordID" = '. $albumID);
        $versionsPostPublish = array();
        foreach($versions as $versionRow) $versionsPostPublish[] = $versionRow;

        $this->logOut();
        $this->logInWithPermission('Album_CRUD');
        $this->assertTrue($album->canDelete());

        $album->delete();
        $this->assertTrue(!$album->isPublished());

        $versions = DB::query('Select * FROM "SiteTree_versions" WHERE "RecordID" = '. $albumID);
        $versionsPostDelete = array();
        foreach($versions as $versionRow) $versionsPostDelete[] = $versionRow;

        $this->assertTrue($versionsPostPublish == $versionsPostDelete);

    }

}
