<?php
namespace Fixzeus\Tests;

use PHPUnit_Framework_TestCase;
use Fixzeus\Model\TType;
use Fixzeus\Model\TMap;

class TMapTest extends PHPUnit_Framework_TestCase
{
    public function mapDataProvider()
    {
        return array(
            array(
                array(
                    'var' => 'success',
                    'type' => TType::MAP,
                    'ktype' => TType::BYTE,
                    'vtype' => TType::STRING,
                    'key' => array(
                        'type' => TType::BYTE
                    ),
                    'val' => array(
                        'type' => TType::STRING
                    )
                )
            )
        );
    }

    /**
     * @dataProvider mapDataProvider
     */
    public function testGetMap($mapData)
    {
        $this->assertInternalType('array', TMap::getMap($mapData));
    }
}
