<?php

class DetailPageTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'dynamic-core/tests/DynamicCoreTest.yml';

    /**
     *
     */
    public function testGetCMSFields()
    {
        $object = $this->objFromFixture('DetailPage', 'page1');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf('FieldList', $fields);
    }

    /**
     *
     */
    public function testGetPageLinks()
    {
        $object = $this->objFromFixture('DetailPage', 'page1');
        $this->assertEquals($object->getPageLinks(), $object->Links()->sort('SortOrder'));
    }

    /**
     *
     */
    public function testCanView()
    {
        $object = $this->objFromFixture('DetailPage', 'page1');

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
        $object = $this->objFromFixture('DetailPage', 'page1');

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
        $object = $this->objFromFixture('DetailPage', 'page1');

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
        $object = $this->objFromFixture('DetailPage', 'page1');

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
        $object = singleton('DetailPage');
        $expected = array(
            'DetailPage_CRUD' => 'Create, Update and Delete a Detail Page',
        );
        $this->assertEquals($expected, $object->providePermissions());
    }
}
