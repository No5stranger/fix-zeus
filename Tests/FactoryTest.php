<?php
namespace Fixzeus\Tests;

use PHPUnit_Framework_TestCase;
use Fixzeus\Factory;

class FactoryTest extends PHPUnit_Framework_TestCase
{
    public function fixDataProvider()
    {
        return array(
            array(
                array(
                    'type' => 'base', //just mark type
                    'service' => 'gfix',
                    'method' => 'ping'
                )
            ),
            array(
                array(
                    'type' => 'struct', //just mark type
                    'service' => 'gfix',
                    'method' => 'get_tp'
                )
            ),
            array(
                array(
                    'type' => 'map', //just mark type
                    'service' => 'gfix',
                    'method' => 'mcount_tp'
                )
            ),
            array(
                array(
                    'type' => 'lst', //just mark type
                    'service' => 'gfix',
                    'method' => 'query_tr'
                )
            ),
        );
    }

    /**
     * @dataProvider fixDataProvider
     */
    public function testFix($fixData)
    {
        if ($fixData['type'] === 'struct') {
            $this->assertInternalType('object', Factory::fix($fixData['service'], $fixData['method']));
            return true;
        }
        $this->assertInternalType('array', Factory::fix($fixData['service'], $fixData['method']));
    }

    /**
     * @dataProvider fixDataProvider
     */
    public function testGetValueType($fixData)
    {
        $this->assertEquals(Factory::getValueType(array($fixData)), $fixData['type']);
    }
}
