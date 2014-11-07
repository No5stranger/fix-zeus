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
                    'type' => 'base_bool', //just mark type
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
        $service = array(
            'gfix' => 'GfixService_'
        );
        $path = __DIR__ . '/special.json';
        $fixZeusFactory = new Factory($service, $path);
        if ($fixData['type'] === 'struct') {
            $this->assertInternalType('object', $fixZeusFactory->fix($fixData['service'], $fixData['method']));
            return true;
        }
        if ($fixData['type'] === 'base_bool') {
            $this->assertInternalType('bool', $fixZeusFactory->fix($fixData['service'], $fixData['method']));
            return true;
        }
        $this->assertInternalType('array', $fixZeusFactory->fix($fixData['service'], $fixData['method']));
    }

    /**
     * @dataProvider fixDataProvider
     */
    public function testGetValueType($fixData)
    {
        $this->assertEquals(Factory::getValueType(array($fixData)), $fixData['type']);
    }
}
