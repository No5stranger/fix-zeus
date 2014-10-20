<?php
namespace Fixzeus\Tests;

use PHPUnit_Framework_TestCase;
use Fixzeus\Model\TType;
use Fixzeus\Model\TStruct;

class TStructTest extends PHPUnit_Framework_TestCase
{
    public function structDataProvider()
    {
        return array(
            array(
                array(
                    'var' => 'success',
                    'type' => TType::STRUCT,
                    'class' => '\GEOS\TPoi'
                )
            )
        );
    }

    /**
     * @dataProvider structDataProvider
     */
    public function testGetStruct($structData)
    {
        //$this->assertInternalType('array', TStruct::getStruct($structData));
    }
}
