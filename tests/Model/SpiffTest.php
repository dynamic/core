<?php

namespace Dynamic\Core\Test\Model;

use Dynamic\Core\Model\Spiff;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

class SpiffTest extends SapphireTest
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
        $object = $this->objFromFixture(Spiff::class, 'default');
        $fields = $object->getCMSFields();
        $this->assertInstanceOf(FieldList::class, $fields);
    }
}