<?php

namespace Dynamic\Core\Test\Page;

use Dynamic\Core\Page\LandingPage;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;
use SilverStripe\Security\Member;

class LandingPageTest extends SapphireTest
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
        $object = $this->objFromFixture(LandingPage::class, 'default');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }

    /**
     *
     */
    public function testCanView()
    {
        $object = $this->objFromFixture(LandingPage::class, 'default');

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
        $object = $this->objFromFixture(LandingPage::class, 'default');

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
        $object = $this->objFromFixture(LandingPage::class, 'default');

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
        $object = $this->objFromFixture(LandingPage::class, 'default');

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
        $object = singleton(LandingPage::class);
        $expected = array(
            'LandingPage_CRUD' => 'Create, Update and Delete a Landing Page',
        );
        $this->assertEquals($expected, $object->providePermissions());
    }
}
