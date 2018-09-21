<?php

namespace Dynamic\Core\Test;

use Dynamic\Core\Page\NewsArticle;
use Dynamic\Core\Page\NewsHolder;
use SilverStripe\ORM\DB;

class NewsArticleTest extends DC_Test
{

    protected static $use_draft_site = true;

    function setUp(){
        parent::setUp();

        $holder = NewsHolder::create();
        $holder->Title = "News";
        $holder->write();
        $holder->doPublish();
    }

    function testNewsArticleCreation(){

        $this->logInWithPermission('News_CRUD');
        $page = singleton(NewsArticle::class);
        $this->assertTrue($page->canCreate());

        $holder = NewsHolder::get()->first();

        $news = new NewsArticle();
        $news->ParentID = $holder->ID;
        $news->Title = 'Our First News Article';
        $news->DateAuthored = date('Y-m-d H:i:s', strtotime('now'));
        $news->Author = 'Dynamic Inc.';
        $news->Featured = false;
        $news->write();
        $news->doPublish();
        $newsID = $news->ID;

        $this->assertTrue($newsID == NewsArticle::get()->first()->ID);

        $this->logOut();

    }

    function testNewsArticleDeletion(){

        $this->logInWithPermission('ADMIN');

        $holder = NewsHolder::get()->first();

        $news = new NewsArticle();
        $news->ParentID = $holder->ID;
        $news->Title = 'Our First News Article';
        $news->DateAuthored = date('Y-m-d H:i:s', strtotime('now'));
        $news->Author = 'Dynamic Inc.';
        $news->Featured = false;
        $news->write();
        $news->doPublish();
        $newsID = $news->ID;

        $this->assertTrue($news->isPublished());

        $versions = DB::query('Select * FROM "NewsArticle_Versions" WHERE "RecordID" = '. $newsID);
        $versionsPostPublish = array();
        foreach($versions as $versionRow) $versionsPostPublish[] = $versionRow;

        $this->logOut();
        $this->logInWithPermission('News_CRUD');
        $this->assertTrue($news->canDelete());

        $news->delete();
        $this->assertFalse($news->isPublished());

        $versions = DB::query('Select * FROM "NewsArticle_Versions" WHERE "RecordID" = '. $newsID);
        $versionsPostDelete = array();
        foreach($versions as $versionRow) $versionsPostDelete[] = $versionRow;

        $this->assertTrue($versionsPostPublish == $versionsPostDelete);

    }

}
