<?php

class LandingPageTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'dynamic-core/tests/DynamicCoreTest.yml';

    /**
     *
     */
    public function testCanView()
    {
        $object = $this->objFromFixture('LandingPage', 'default');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canView($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertTrue($object->canView($member));
    }

    /**
     *
     */
    public function testCanEdit()
    {
        $object = $this->objFromFixture('LandingPage', 'default');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canEdit($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canEdit($member));
    }

    /**
     *
     */
    public function testCanDelete()
    {
        $object = $this->objFromFixture('LandingPage', 'default');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canDelete($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canDelete($member));
    }

    /**
     *
     */
    public function testCanCreate()
    {
        $object = $this->objFromFixture('LandingPage', 'default');

        $admin = $this->objFromFixture('Member', 'admin');
        $this->assertTrue($object->canCreate($admin));

        $member = $this->objFromFixture('Member', 'default');
        $this->assertFalse($object->canCreate($member));
    }

    /**
     *
     */
    public function testProvidePermissions()
    {
        $object = singleton('LandingPage');
        $expected = array(
            'LandingPage_CRUD' => 'Create, Update and Delete a Landing Page',
        );
        $this->assertEquals($expected, $object->providePermissions());
    }
}
