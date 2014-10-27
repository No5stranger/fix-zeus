<?php
namespace Fixzeus\Tests;

use PHPUnit_Framework_TestCase;
use Fixzeus\Model\TSpecial;

class TSpecialTest extends PHPUnit_Framework_TestCase
{
    public function defineValueDataProvider()
    {
        return array(
            array(__DIR__ . '/special.json', 'name', 'string'),
            array(__DIR__ . '/special.json', 'date', 'string')
        );
    }

    /**
     * @dataProvider defineValueDataProvider
     */
    public function testDefineValue($path, $var, $type)
    {
        $this->assertInternalType($type, TSpecial::defineValue($path, $var));
    }

    public function reviseDataProvider()
    {
        return array(
            array(
                array(
                    'var' => 'latitude',
                    'type' => 'float'
                )
            ),
            array(
                array(
                    'var' => 'longitude',
                    'type' => 'float'
                )
            ),
            array(
                array(
                    'var' => 'address',
                    'type' => 'string'
                )
            ),
            array(
                array(
                    'var' => 'city',
                    'type' => 'string'
                )
            ),
            array(
                array(
                    'var' => 'created_at',
                    'type' => 'string'
                )
            ),
            array(
                array(
                    'var' => 'name',
                    'type' => 'string'
                )
            ),
            array(
                array(
                    'var' => 'pguid',
                    'type' => 'string'
                )
            ),
            array(
                array(
                    'var' => 'mobile',
                    'type' => 'string'
                )
            ),
            array(
                array(
                    'var' => 'unknow',
                    'type' => 'bool'
                )
            ),
        );
    }

    /**
     * @dataProvider reviseDataProvider
     */
    public function testReviseData($reviseData)
    {
        $this->assertInternalType($reviseData['type'], TSpecial::reviseData($reviseData['var']));
    }

    public function testGetBool()
    {
        $this->assertInternalType('bool', TSpecial::getBool());
        $this->assertInternalType('integer', TSpecial::getBool(true));
    }

    public function customDataProvider()
    {
        return array(
            array(__DIR__ . '/special.json', 'name', 'cjp'),
            array('TB.php', 'cjp', false)
        );
    }

    /**
     * @dataProvider customDataProvider
     */
    public function testCustomize($path, $var, $val)
    {
        $this->assertEquals(TSpecial::customize($path, $var), $val);
    }

    public function rangeValueDataProvider()
    {
        return array(
            array(__DIR__ . '/special.json', 'integer', 'integer'),
            array(__DIR__ . '/special.json', 'date', 'string'),
            array(__DIR__ . '/special.json', 'time', 'string'),
            array(__DIR__ . '/special.json', 'datetime', 'string'),
            array(__DIR__ . '/special.json', 'unixtime', 'integer'),
            array(__DIR__ . '/special.json', 'user_agent', 'string'),
            //chrome, firefox, safari, opera, internetExplorer
            array('TB.php', 'cjp', "bool")
        );
    }

    /**
     * @dataProvider rangeValueDataProvider
     */
    public function testRangeValue($path, $var, $type)
    {
        $this->assertInternalType($type, TSpecial::rangeValue($path, $var));
    }
}
