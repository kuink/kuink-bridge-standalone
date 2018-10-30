<?php
/**
 * Created by PhpStorm.
 * User: jmp
 * Date: 10/30/2018
 * Time: 12:30 AM
 */

namespace Kuink\Bridge\Tests\Unit;

use Kuink\Bridge\Config;

class ConfigTest extends BaseUnitTest
{

    /**
     * Tests set a value
     */
    public function testSetValue()
    {
        $config = new Config();
        $config->set('a', 'b');
        $this->assertTrue($config->exists('a'), 'Key a exists');
        $this->assertFalse($config->exists('a1'), 'Key a1 does not exist');
    }

    /**
     * Tests get scalar values
     */
    public function testGetScalarValue()
    {
        $config = new Config();
        $config->set('a', 'b');
        $value = $config->get('a');
        $this->assertEquals('b', $value, 'Value returned is the same as defined before');
    }

    /**
     * Test get non existent configurations
     */
    public function testGetNonExistentValue()
    {
        $config = new Config();
        $value = $config->get('a');
        $this->assertNull($value, 'Value is null');

        $value = $config->get('a', 'my_default');
        $this->assertEquals('my_default', $value);
    }

    /**
     * Tests get multi dimensional configurations
     */
    public function testGetMultidimensionalConfig()
    {
        $config = new Config();
        $config->set('a', [
            'b' => 'c',
            'd' => [
                'e' => 'f'
            ]
        ]);

        $a = $config->get('a');
        $this->assertTrue(get_class($a) == Config::class, 'a is a config object');
        $c = $a->get('b');
        $this->assertEquals('c', $c, 'c is returned');

        $f = $config->get('a')->get('d')->get('e');
        $this->assertEquals('f', $f, 'f is returned by fluent calls');
    }
}
