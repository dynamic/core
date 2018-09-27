<?php

namespace Dynamic\Core\Test\Page;

use Dynamic\Core\Page\NewsArticle;
use Dynamic\Core\Page\NewsHolder;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DB;
use SilverStripe\Security\Member;

class NewsArticleTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = '../DynamicCoreTest.yml';

    /**
     *
     */
    public function testGetCMSFields()
    {
        $object = $this->objFromFixture(NewsArticle::class, 'article1');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }

    /**
     *
     */
    public function testGetPageLinks()
    {
        $object = $this->objFromFixture(NewsArticle::class, 'article1');
        $this->assertEquals($object->getPageLinks(), $object->Links()->sort('SortOrder'));
    }

    /**
     *
     */
    public function testCanView()
    {
        $object = $this->objFromFixture(NewsArticle::class, 'article1');

        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canView($admin));

        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertTrue($object->canView($member));
    }

    /**
     *
     */
    public function testCanEdit()
    {
        $object = $this->objFromFixture(NewsArticle::class, 'article1');

        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canEdit($admin));

        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertFalse($object->canEdit($member));
    }

    /**
     *
     */
    public function testCanDelete()
    {
        $object = $this->objFromFixture(NewsArticle::class, 'article1');

        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canDelete($admin));

        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertFalse($object->canDelete($member));
    }

    /**
     *
     */
    public function testCanCreate()
    {
        $object = $this->objFromFixture(NewsArticle::class, 'article1');

        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canCreate($admin));

        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertFalse($object->canCreate($member));
    }

    /**
     *
     */
    public function testProvidePermissions()
    {
        $object = singleton(NewsArticle::class);
        $expected = array(
            'News_CRUD' => 'Create, Update and Delete a News Article',
        );
        $this->assertEquals($expected, $object->providePermissions());
    }
}
