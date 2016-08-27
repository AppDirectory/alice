<?php

/*
 * This file is part of the Alice package.
 *
 * (c) Nelmio <hello@nelm.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nelmio\Alice\Definition\Value;

use Nelmio\Alice\Definition\ValueInterface;

/**
 * @covers Nelmio\Alice\Definition\Value\ChoiceListValue
 */
class ChoiceListValueTest extends \PHPUnit_Framework_TestCase
{
    public function testIsAValue()
    {
        $this->assertTrue(is_a(ListValue::class, ValueInterface::class, true));
    }

    public function testReadAccessorsReturnPropertiesValues()
    {
        $list = [];
        $value = new ChoiceListValue($list);

        $this->assertEquals($list, $value->getValue());

        $list = [new \stdClass()];
        $value = new ChoiceListValue($list);

        $this->assertEquals($list, $value->getValue());
    }

    public function testIsImmutable()
    {
        $value = new ChoiceListValue([
            $std = new \stdClass(),
        ]);

        // Mutate input value
        $std->foo = 'bar';

        // Mutate retrieved value
        $value->getValue()[0]->foo = 'baz';

        $this->assertEquals(
            [
                new \stdClass(),
            ],
            $value->getValue()
        );
    }

    public function testIsCastableIntoAString()
    {
        $value = new ChoiceListValue([]);
        $this->assertEquals('(choice) vals', (string) $value);
    }
}
