<?php

namespace Dynamic\Core\Test\Model;

use Dynamic\Core\Model\LinkObject;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

class LinkObjectTest extends SapphireTest
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
        $object = $this->objFromFixture(LinkObject::class, 'default');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }
}
