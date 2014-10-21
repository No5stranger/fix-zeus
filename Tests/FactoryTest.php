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
                    'service' => 'geos',
                    'method' => 'ping'
                )
            ),
            array(
                array(
                    'type' => 'struct', //just mark type
                    'service' => 'geos',
                    'method' => 'get_poi'
                )
            ),
            array(
                array(
                    'type' => 'map', //just mark type
                    'service' => 'geos',
                    'method' => 'mcount_restaurant_by_position'
                )
            ),
            array(
                array(
                    'type' => 'lst', //just mark type
                    'service' => 'geos',
                    'method' => 'query_rrc_region'
                )
            ),
        );
    }

    /**
     * @dataProvider fixDataProvider
     */
    public function testFix($fixData)
    {
        //d($fixData['service'], $fixData['method']);
        $this->assertInternalType('array', Factory::fix($fixData['service'], $fixData['method']));
    }
}
