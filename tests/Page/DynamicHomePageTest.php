<?php

namespace Dynamic\Core\Test\Page;

use Dynamic\Core\Page\DynamicHomePage;
use Dynamic\Core\Test\DC_Test;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;
use SilverStripe\Security\Member;

class DynamicHomePageTest extends SapphireTest
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
        $object = $this->objFromFixture(DynamicHomePage::class, 'newhome1');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }
    
    /**
     *
     */
    public function testCanView()
    {
        $object = $this->objFromFixture(DynamicHomePage::class, 'newhome1');

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
        $object = $this->objFromFixture(DynamicHomePage::class, 'newhome1');

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
        $object = $this->objFromFixture(DynamicHomePage::class, 'newhome1');

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
        $object = $this->objFromFixture(DynamicHomePage::class, 'newhome1');

        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertFalse($object->canCreate($admin));

        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertFalse($object->canCreate($member));
    }

    /**
     *
     */
    public function testProvidePermissions()
    {
        $object = singleton(DynamicHomePage::class);
        $expected = array(
            'DynamicHomePage_CRUD' => 'Create, Update and Delete a Home Page',
        );
        $this->assertEquals($expected, $object->providePermissions());
    }
}
