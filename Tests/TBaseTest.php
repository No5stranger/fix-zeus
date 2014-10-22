<?php
namespace Fixzeus\Tests;

use PHPUnit_Framework_TestCase;
use Mockery;
use Exception;
use Fixzeus\Model\TType;
use Fixzeus\Model\TBase;

class TBaseTest extends PHPUnit_Framework_TestCase
{
    public function tBaseDataProvider()
    {
        return array(
            array(
                array(
                    'var' => 'bool',
                    'type' => TType::BOOL
                )
            ),
            array(
                array(
                    'var' => '8integer',
                    'type' => TType::BYTE
                )
            ),
            array(
                array(
                    'var' => '16integer',
                    'type' => TType::I16
                )
            ),
            array(
                array(
                    'var' => '32integer',
                    'type' => TType::I32
                )
            ),
            array(
                array(
                    'var' => '64integer',
                    'type' => TType::I64
                )
            ),
            array(
                array(
                    'var' => 'float',
                    'type' => TType::DOUBLE
                )
            ),
            array(
                array(
                    'var' => 'string',
                    'type' => TType::STRING
                )
            ),
            array(
                array(
                    'var' => 'latitude',
                    'type' => TType::DOUBLE
                )
            ),
            array(
                array(
                    'var' => 'longitude',
                    'type' => TType::DOUBLE
                )
            ),
            array(
                array(
                    'var' => 'is_xxx',
                    'type' => TType::BOOL
                )
            ),
            array(
                array(
                    'var' => 'created_at',
                    'type' => TType::STRING
                )
            ),
            array(
                array(
                    'var' => 'pguid',
                    'type' => TType::STRING
                )
            ),
            array(
                array(
                    'var' => 'mobile',
                    'type' => TType::STRING
                )
            ),
            array(
                array(
                    'var' => 'unknow',
                    'type' => 99
                )
            ),
            array(
                array(
                    'rav' => 'abc',
                    'type' => 99
                )
            )
        );
    }

    /**
     * @dataProvider tBaseDataProvider
     */
    public function testGet($tBaseData)
    {
        $fixData = TBase::get($tBaseData);
        if (in_array($tBaseData['type'], array(TType::BYTE, TType::I16, TType::I32, TType::I64))) {
            $this->assertInternalType('integer', $fixData[$tBaseData['var']]);
            return true;
        }
        switch ($tBaseData['type']) {
            case TType::BOOL:
                $this->assertInternalType('bool', $fixData[$tBaseData['var']]);
                break;
            case TType::DOUBLE:
                $this->assertInternalType('float', $fixData[$tBaseData['var']]);
                break;
            case TType::STRING:
                $this->assertInternalType('string', $fixData[$tBaseData['var']]);
                break;
            default:
                $this->assertInstanceOf('Exception', $fixData);
        }
    }
}
