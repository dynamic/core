<?php

namespace Dynamic\Core\Test\Model;

use Dynamic\Core\Model\Tag;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

class TagTest extends SapphireTest
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
        $object = $this->objFromFixture(Tag::class, 'default');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }
}
