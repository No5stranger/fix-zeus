<?php
namespace Fixzeus\Tests;

use PHPUnit_Framework_TestCase;
use Fixzeus\Model\TType;
use Fixzeus\Model\TLst;

class TLstTest extends PHPUnit_Framework_TestCase
{
    public function lstDataProvider()
    {
        return array(
            array(
                array(
                    'var' => 'success',
                    'type' => TType::LST,
                    'etype' => TType::STRUCT,
                    'elem' => array(
                        'type' => TType::STRUCT,
                        'class' => '\GEOS\TRrcRegion'
                    )
                )
            ),
            array(
                array(
                    'var' => 'success',
                    'type' => TType::LST,
                    'etype' => TType::STRUCT,
                    'elem' => array(
                        'type' => TType::STRUCT,
                        'class' => '\GEOS\TRrcRegionRanking'
                    )
                )
            ),
            array(
                array(
                    'var' => 'success',
                    'type' => TType::LST,
                    'etype' => TType::STRING,
                    'elem' => array(
                        'type' => TType::STRING,
                    )
                )
            ),
            array(
                array(
                    'var' => 'success',
                    'type' => TType::LST,
                    'etype' => TType::MAP,
                    'elem' => array(
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
            )
        );
    }

    /**
     * @dataProvider lstDataProvider
     */
    public function testGetLst($lstData)
    {
        $this->assertInternalType('array', TLst::getLst($lstData));
    }
}
